<?php
namespace App\Http\Container;

use App\Http\Action\RegisterFormAction;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class RegisterFormActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new RegisterFormAction($container->get(TemplateRendererInterface::class));
    }
}
