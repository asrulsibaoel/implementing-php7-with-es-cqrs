<?php
namespace App\Http\Container;

use App\Http\Action\ProductDetailAction;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ProductDetailActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ProductDetailAction($container->get(TemplateRendererInterface::class));
    }
}
