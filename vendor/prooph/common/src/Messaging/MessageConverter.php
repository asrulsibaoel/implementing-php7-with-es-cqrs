<?php
/*
 * This file is part of the prooph/common.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 7/26/15 - 3:27 PM
 */

namespace Prooph\Common\Messaging;

/**
 * Interface MessageConverter
 *
 * A message converter is able to convert a Message into an array
 *
 * @package Prooph\Common\Messaging
 * @author Alexander Miertsch <contact@prooph.de>
 */
interface MessageConverter
{
    /**
     * The result array MUST contain the following data structure:
     *
     * [
     *   'message_name' => string,
     *   'uuid' => string,
     *   'version' => int,
     *   'payload' => array, //MUST only contain sub arrays and/or scalar types, objects, etc. are not allowed!
     *   'metadata' => array, //MUST only contain key/value pairs with values being only scalar types!
     *   'created_at' => \DateTimeInterface,
     * ]
     *
     * The correct structure and types are asserted by MessageDataAssertion::assert()
     * so make sure that the returned array of your custom conversion logic passes the assertion.
     *
     * @param Message $domainMessage
     * @return array
     */
    public function convertToArray(Message $domainMessage);
}
