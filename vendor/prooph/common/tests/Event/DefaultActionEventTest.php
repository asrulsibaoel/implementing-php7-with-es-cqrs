<?php
/*
 * This file is part of the prooph/common.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 5/22/15 - 7:12 PM
 */
namespace ProophTest\Common\Event;

use Prooph\Common\Event\DefaultActionEvent;

class DefaultActionEventTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return DefaultActionEvent
     */
    private function getTestEvent()
    {
        return new DefaultActionEvent('test-event', 'target', ['param1' => 'foo']);
    }

    /**
     * @test
     */
    public function it_can_be_initialized_with_a_name_a_target_and_params()
    {
        $event = $this->getTestEvent();

        $this->assertEquals('test-event', $event->getName());
        $this->assertEquals('target', $event->getTarget());
        $this->assertEquals(['param1' => 'foo'], $event->getParams());
    }

    /**
     * @test
     */
    public function it_can_initialized_without_a_target_and_params()
    {
        $event = new DefaultActionEvent('test-event');

        $this->assertNull($event->getTarget());
        $this->assertEquals([], $event->getParams());
    }

    /**
     * @test
     */
    public function it_returns_param_if_set()
    {
        $event = $this->getTestEvent();
        $this->assertEquals('foo', $event->getParam('param1'));
        $event->setParam('param1', 'bar');
        $this->assertEquals('bar', $event->getParam('param1'));
    }

    /**
     * @test
     */
    public function it_returns_null_if_param_is_not_set_and_no_other_default_is_given()
    {
        $this->assertNull($this->getTestEvent()->getParam('unknown'));
    }

    /**
     * @test
     */
    public function it_returns_default_if_param_is_not_set()
    {
        $this->assertEquals('default', $this->getTestEvent()->getParam('unknown', 'default'));
    }

    /**
     * @test
     */
    public function it_changes_name_when_new_one_is_set()
    {
        $event = $this->getTestEvent();

        $event->setName('new name');

        $this->assertEquals('new name', $event->getName());
    }

    /**
     * @test
     * @dataProvider provideInvalidNames
     * @expectedException \InvalidArgumentException
     */
    public function it_only_allows_strings_as_event_name($invalidName)
    {
        $this->getTestEvent()->setName($invalidName);
    }

    /**
     * @return array
     */
    public function provideInvalidNames()
    {
        return [
            [1],
            [true],
            [[]],
            [new \stdClass()]
        ];
    }

    /**
     * @test
     */
    public function it_overrides_params_array_if_new_one_is_set()
    {
        $event = $this->getTestEvent();

        $event->setParams(['param_new' => 'bar']);

        $this->assertEquals(['param_new' => 'bar'], $event->getParams());
    }

    /**
     * @test
     */
    public function it_allows_object_implementing_array_access_as_params()
    {
        $arrayLikeObject = new \ArrayObject(['object_param' => 'baz']);

        $event = $this->getTestEvent();

        $event->setParams($arrayLikeObject);

        $this->assertSame($arrayLikeObject, $event->getParams());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_does_not_allow_params_object_that_is_not_of_type_array_access()
    {
        $stdObj = new \stdClass();

        $stdObj->param1 = 'foo';

        $this->getTestEvent()->setParams($stdObj);
    }

    /**
     * @test
     */
    public function it_changes_target_if_new_is_set()
    {
        $event = $this->getTestEvent();

        $target = new \stdClass();

        $event->setTarget($target);

        $this->assertSame($target, $event->getTarget());
    }

    /**
     * @test
     */
    public function it_indicates_that_propagation_should_be_stopped()
    {
        $event = $this->getTestEvent();

        $this->assertFalse($event->propagationIsStopped());

        $event->stopPropagation();

        $this->assertTrue($event->propagationIsStopped());
    }
}
