<?php


namespace App\Http\Container;

use App\Http\Action\UserProductListingAction;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class UserProductListingActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new UserProductListingAction($container->get(TemplateRendererInterface::class));
    }
}
