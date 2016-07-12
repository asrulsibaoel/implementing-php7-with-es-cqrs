<?php
/*
 * This file is part of the prooph/common.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 22.08.15 - 15:27
 */
namespace ProophTest\Common\Event;

use PHPUnit_Framework_TestCase as TestCase;
use Prooph\Common\Event\DefaultListenerHandler;

/**
 * Class DefaultListenerHandlerTest
 * @package ProophTest\Common\Event
 */
class DefaultListenerHandlerTest extends TestCase
{
    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Given parameter listener should be callable or an instance of ActionEventListener
     */
    public function it_throws_exception_when_invalid_listener_given()
    {
        new DefaultListenerHandler('invalid');
    }
}
