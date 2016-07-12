<?php

namespace App\Http\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\Plugin\Log\Infrastructure\Log;
use App\Plugin\Log\LogInterface;
use App\Projection\Product\ProductFinder;

final class RegisterFormAction
{
    private $template;

    public function __construct(TemplateRendererInterface $template)
    {
        $this->template = $template;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $out = null
    ) : ResponseInterface {
        
        $data = [];
        
        return new HtmlResponse($this->template->render('app::register', $data));
    }
}
