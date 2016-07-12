<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/interop-config for the canonical source repository
 * @copyright Copyright (c) 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/interop-config/blob/master/LICENSE.txt New BSD License
 */

namespace Interop\Config;

/**
 * HasMandatoryOptions Interface
 *
 * Use this interface if you have mandatory options
 */
interface RequiresMandatoryOptions
{
    /**
     * Returns a list of mandatory options which must be available
     *
     * @return string[] List with mandatory options
     */
    public function mandatoryOptions();
}
