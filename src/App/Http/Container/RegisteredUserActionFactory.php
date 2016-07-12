<?php
namespace App\Http\Container;

use App\Http\Action\RegisteredUserAction;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class RegisteredUserActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new RegisteredUserAction($container->get(TemplateRendererInterface::class));
    }
}
