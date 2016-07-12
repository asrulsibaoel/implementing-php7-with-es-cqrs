<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Projection\Product\Container;

use App\Projection\Product\ProductFinder;
use App\Projection\Product\ProductProjector;
use Interop\Container\ContainerInterface;

/**
 * Description of ProductProjectorFactory
 *
 * @author asrulsibaoel
 */
final class ProductProjectorFactory
{

    public function __invoke(ContainerInterface $container) : ProductProjector
    {
        return new ProductProjector(
                $container->get('doctrine.connection.default'),
                $container->get(ProductFinder::class)
        );
    }

}
