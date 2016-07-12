<?php


namespace App\Http\Container;

use App\Http\Action\UserAddProductAction;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class UserAddProductActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new UserAddProductAction($container->get(TemplateRendererInterface::class));
    }
}
