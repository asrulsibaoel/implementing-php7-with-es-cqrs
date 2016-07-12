<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Projection\Product\Container;

use App\Projection\Product\ProductFinder;
use Interop\Container\ContainerInterface;

/**
 * Description of ProductFinderFactory
 *
 * @author asrulsibaoel
 */
final class ProductFinderFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ProductFinder($container->get('doctrine.connection.default'));
    }
}
