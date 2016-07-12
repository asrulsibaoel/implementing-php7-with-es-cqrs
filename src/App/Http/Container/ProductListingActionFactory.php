<?php


namespace App\Http\Container;

use App\Http\Action\ProductListingAction;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ProductListingActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ProductListingAction($container->get(TemplateRendererInterface::class));
    }
}
