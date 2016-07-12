<?php
namespace App\Http\Container;

use App\Http\Action\HomePageAction;
use App\Projection\Product\ProductFinder;
use Interop\Container\ContainerInterface;
use Monolog\Logger;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomePageActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new HomePageAction(
                $container->get(TemplateRendererInterface::class),
                $container->get(ProductFinder::class),
                $container->get(Logger::class)
                );
    }
}
