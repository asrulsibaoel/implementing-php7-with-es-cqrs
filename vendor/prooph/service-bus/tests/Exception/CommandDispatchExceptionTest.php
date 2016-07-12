<?php
/*
 * This file is part of the prooph/service-bus.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 11/21/15 - 6:43 PM
 */
namespace ProophTest\ServiceBus\Exception;

use Prooph\Common\Event\DefaultActionEvent;
use Prooph\ServiceBus\Exception\CommandDispatchException;
use Prooph\ServiceBus\Exception\MessageDispatchException;
use Prooph\ServiceBus\MessageBus;
use ProophTest\ServiceBus\TestCase;

class CommandDispatchExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function it_wraps_a_message_dispatch_exception_and_tracks_pending_commands()
    {
        $pendingCommands = ['dispatchMe', 'tellMe'];

        $actionEvent = new DefaultActionEvent(MessageBus::EVENT_INVOKE_HANDLER);

        $prevException = new \Exception('previous');

        $messageDispatchException = MessageDispatchException::failed($actionEvent, $prevException);

        $commandDispatchException = CommandDispatchException::wrap($messageDispatchException, $pendingCommands);

        $this->assertSame($actionEvent, $commandDispatchException->getFailedDispatchEvent());
        $this->assertSame($prevException, $commandDispatchException->getPrevious());
        $this->assertSame($pendingCommands, $commandDispatchException->getPendingCommands());
    }

    /**
     * @test
     */
    public function it_can_also_wrap_a_normal_exception()
    {
        $pendingCommands = ['dispatchMe', 'tellMe'];

        $prevException = new \Exception('previous');

        $commandDispatchException = CommandDispatchException::wrap($prevException, $pendingCommands);

        $this->assertSame('Command dispatch failed. See previous exception for details.', $commandDispatchException->getMessage());
        $this->assertSame(422, $commandDispatchException->getCode());
        $this->assertSame($prevException, $commandDispatchException->getPrevious());
        $this->assertSame($pendingCommands, $commandDispatchException->getPendingCommands());
    }
}
