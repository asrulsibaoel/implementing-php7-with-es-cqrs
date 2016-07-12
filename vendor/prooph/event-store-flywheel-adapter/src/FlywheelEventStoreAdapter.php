<?php

/*
 * This file is part of the prooph/event-store-flywheel-adapter.
 *
 * (c) 2016 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prooph\EventStore\Adapter\Flywheel;

use ArrayIterator;
use DateTimeInterface;
use Iterator;
use JamesMoss\Flywheel\Config;
use JamesMoss\Flywheel\Document;
use JamesMoss\Flywheel\Repository;
use Prooph\Common\Messaging\Message;
use Prooph\Common\Messaging\MessageConverter;
use Prooph\Common\Messaging\MessageDataAssertion;
use Prooph\Common\Messaging\MessageFactory;
use Prooph\EventStore\Adapter\Adapter;
use Prooph\EventStore\Stream\Stream;
use Prooph\EventStore\Stream\StreamName;

final class FlywheelEventStoreAdapter implements Adapter
{
    /**
     * @var string
     */
    private $rootDir;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @var MessageConverter
     */
    private $messageConverter;

    /**
     * @param string           $rootDir          The root directory to store the event files
     * @param MessageFactory   $messageFactory   To create message from array
     * @param MessageConverter $messageConverter To convert message into array
     */
    public function __construct($rootDir, MessageFactory $messageFactory, MessageConverter $messageConverter)
    {
        $this->rootDir = $rootDir;
        $this->messageFactory = $messageFactory;
        $this->messageConverter = $messageConverter;
    }

    /**
     * @param Stream $stream
     */
    public function create(Stream $stream)
    {
        $this->appendTo($stream->streamName(), $stream->streamEvents());
    }

    /**
     * @param StreamName $streamName
     * @param Iterator   $domainEvents
     */
    public function appendTo(StreamName $streamName, Iterator $streamEvents)
    {
        foreach ($streamEvents as $event) {
            $this->insertEvent($streamName, $event);
        }
    }

    /**
     * @param StreamName $streamName
     * @param null|int   $minVersion Minimum version an event should have
     *
     * @return Stream
     */
    public function load(StreamName $streamName, $minVersion = null)
    {
        $events = $this->loadEvents($streamName, [], $minVersion);

        return new Stream($streamName, $events);
    }

    /**
     * @param StreamName $streamName
     * @param array      $metadata   If empty array is provided, then all events should be returned
     * @param null|int   $minVersion Minimum version an event should have
     *
     * @return ArrayIterator
     */
    public function loadEvents(StreamName $streamName, array $metadata = [], $minVersion = null)
    {
        $repository = $this->getRepositoryForStream($streamName);

        $query = $repository->query();

        // Filter by metadata
        foreach ($metadata as $key => $value) {
            $query->where("metadata.$key", '==', $value);
        }

        // Filter by version
        if (null !== $minVersion) {
            $query->where('version', '>=', $minVersion);
        }

        $documents = $query->orderBy('version ASC')->execute();

        $events = [];
        foreach ($documents as $document) {
            $events[] = $this->convertDocumentToEvent($document);
        }

        return new ArrayIterator($events);
    }

    /**
     * @param StreamName             $streamName
     * @param DateTimeInterface|null $since
     * @param array                  $metadata
     *
     * @return Iterator
     */
    public function replay(StreamName $streamName, DateTimeInterface $since = null, array $metadata = [])
    {
        $repository = $this->getRepositoryForStream($streamName);

        $query = $repository->query();

        // Filter by metadata
        foreach ($metadata as $key => $value) {
            $query->where("metadata.$key", '==', $value);
        }

        // Filter by creation date
        if (null !== $since) {
            $query->where('created_at', '>=', $since->format('Y-m-d\TH:i:s.u'));
        }

        $documents = $query
            ->orderBy(['created_at ASC', 'version ASC'])
            ->execute();

        $events = [];
        foreach ($documents as $document) {
            $events[] = $this->convertDocumentToEvent($document);
        }

        return new ArrayIterator($events);
    }

    /**
     * @param StreamName $streamName
     * @param Message    $event
     */
    private function insertEvent(StreamName $streamName, Message $event)
    {
        $repository = $this->getRepositoryForStream($streamName);
        $document = $this->convertEventToDocument($event);

        $repository->store($document);
    }

    /**
     * @param Message $event
     *
     * @return Document
     */
    private function convertEventToDocument(Message $event)
    {
        $eventArr = $this->messageConverter->convertToArray($event);

        MessageDataAssertion::assert($eventArr);

        $data = [
            'event_id' => $eventArr['uuid'],
            'version' => $eventArr['version'],
            'event_name' => $eventArr['message_name'],
            'payload' => $eventArr['payload'],
            'metadata' => $eventArr['metadata'],
            'created_at' => $eventArr['created_at']->format('Y-m-d\TH:i:s.u'),
        ];

        $document = new Document($data);
        $document->setId($data['event_id']);

        return $document;
    }

    /**
     * @param Document $document
     *
     * @return Message
     */
    private function convertDocumentToEvent(Document $document)
    {
        $createdAt = \DateTimeImmutable::createFromFormat(
            'Y-m-d\TH:i:s.u',
            $document->created_at,
            new \DateTimeZone('UTC')
        );

        return $this->messageFactory->createMessageFromArray($document->event_name, [
            'uuid' => $document->event_id,
            'version' => (int) $document->version,
            'created_at' => $createdAt,
            'payload' => (array) $document->payload,
            'metadata' => (array) $document->metadata,
        ]);
    }

    /**
     * @param StreamName $streamName
     *
     * @return Repository
     */
    private function getRepositoryForStream(StreamName $streamName)
    {
        return new Repository($streamName->toString(), new Config($this->rootDir));
    }
}
