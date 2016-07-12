<?php

namespace App\Http\Action;

use App\Module\Product\Model\ProductCollection;
use App\Module\Product\Model\ProductId;
use App\Module\User\Model\UserCollection;
use App\Module\User\Model\UserId;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use App\Projection\Product\ProductFinder;
use Monolog\Logger;

final class HomePageAction
{
    /**
     *
     * @var TemplateRenderInterface
     */
    private $template;
    
    /**
     *
     * @var ProductFinder
     */
    private $productFinder;
    
    /**
     *
     * @var Logger
     */
    private $logger; 

    public function __construct(TemplateRendererInterface $template, ProductFinder $productFinder, Logger $logger)
    {
        $this->template = $template;
        $this->productFinder = $productFinder;
        $this->logger = $logger;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $out = null
    ) : ResponseInterface {
        $product = $this->productFinder->findLimited(0,7);
        $data = [
            'product' => $product,
        ];
        
        $this->logger->addCritical(json_encode($data));
        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
