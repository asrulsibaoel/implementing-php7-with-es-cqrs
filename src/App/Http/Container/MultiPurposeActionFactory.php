<?php

namespace App\Http\Container;

use App\Http\Action\MultiPurposeAction;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class MultiPurposeActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new MultiPurposeAction($container->get(TemplateRendererInterface::class));
    }
}
