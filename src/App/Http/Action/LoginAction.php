<?php

namespace App\Http\Action;

use LosMiddleware\LosLog\StaticLogger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\ServerUrlHelper;
use Zend\Log\Logger;

final class LoginAction
{
    
    /**
     *
     * @var TemplateRendererInterface 
     */
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

        return new HtmlResponse($this->template->render('app::login', $data));
    }
}
