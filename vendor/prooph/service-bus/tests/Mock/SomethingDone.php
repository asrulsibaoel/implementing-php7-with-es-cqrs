<?php
/*
 * This file is part of the prooph/service-bus.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 08/02/15 - 9:46 PM
 */

namespace ProophTest\ServiceBus\Mock;

use Prooph\Common\Messaging\DomainEvent;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

/**
 * Class SomethingDone
 * @package ProophTest\ServiceBus\Mock
 */
final class SomethingDone extends DomainEvent implements PayloadConstructable
{
    use PayloadTrait;
}
