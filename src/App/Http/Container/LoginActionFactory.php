<?php


namespace App\Http\Container;

use App\Http\Action\LoginAction;
use App\Module\Product\Model\ProductCollection;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class LoginActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new LoginAction($container->get(TemplateRendererInterface::class));
    }
}
