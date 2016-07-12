<?php
declare(strict_types=1);

namespace App\Module\Product\Container\Model\Handler;

use App\Module\Product\Model\Handler\AddProductToDatabaseHandler;
use Interop\Container\ContainerInterface;
use App\Module\Product\Model\ProductCollection;

class AddProductToDatabaseHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AddProductToDatabaseHandler
    {
        return new AddProductToDatabaseHandler($container->get(ProductCollection::class));
    }
}
