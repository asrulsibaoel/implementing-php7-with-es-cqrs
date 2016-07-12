<?php
/*
 * This file is part of the prooph/service-bus.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 08/02/15 - 9:31 PM
 */

namespace ProophTest\ServiceBus\Mock;

/**
 * Class Finder
 * @package ProophTest\ServiceBus\Mock
 */
final class Finder
{
    private $message;

    private $deferred;

    public function customMessage($message, $deferred)
    {
        $this->message = $message;
        $this->deferred = $deferred;
    }

    public function getLastMessage()
    {
        return $this->message;
    }

    public function getLastDeferred()
    {
        return $this->deferred;
    }
}
