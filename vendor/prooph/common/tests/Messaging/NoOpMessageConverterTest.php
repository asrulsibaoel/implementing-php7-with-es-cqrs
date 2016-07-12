<?php
/*
 * This file is part of the prooph/common.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 22.08.15 - 15:00
 */
namespace ProophTest\Common\Messaging;

use PHPUnit_Framework_TestCase as TestCase;
use Prooph\Common\Messaging\DomainMessage;
use Prooph\Common\Messaging\Message;
use Prooph\Common\Messaging\NoOpMessageConverter;

/**
 * Class NoOpMessageConverterTest
 *
 * @package ProophTest\Common\Messaging
 * @author Alexander Miertsch <contact@prooph.de>
 */
final class NoOpMessageConverterTest extends TestCase
{
    /**
     * @test
     */
    public function it_converts_to_array()
    {
        $messageMock = $this->getMockForAbstractClass(DomainMessage::class, [], '', true, true, true, ['toArray']);
        $messageMock->expects($this->once())->method('toArray');

        $converter = new NoOpMessageConverter();
        $converter->convertToArray($messageMock);
    }

    /**
     * @test
     * @expectedException Assert\InvalidArgumentException
     * @expectedExceptionMessage was expected to be instanceof of "Prooph\Common\Messaging\DomainMessage" but is not.
     */
    public function it_throws_exception_when_message_is_not_a_domain_message()
    {
        $messageMock = $this->getMockForAbstractClass(Message::class);

        $converter = new NoOpMessageConverter();
        $converter->convertToArray($messageMock);
    }
}
