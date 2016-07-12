<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Action;

use App\Module\Product\Model\ImageList;
use Prooph\Common\Messaging\MessageFactory;
use Prooph\ServiceBus\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Rhumsaa\Uuid\Uuid;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Helper\ServerUrlHelper;
use App\Module\Product\Model\Command\AddProductToDatabase;

/**
 * Description of UserAddProductRecord
 *
 * @author asrulsibaoel
 */
final class UserAddProductRecordAction
{
    /**
     *
     * @var CommandBus
     */
    private $commandBus;
    
    /**
     *
     * @var MessageFactory
     */
    private $commandFactory;
    
    /**
     *
     * @var ServerUrlHelper
     */
    private $urlHelper;

    /**
     * 
     * @param CommandBus $commandBus
     * @param MessageFactory $commandFactory
     * @param ServerUrlHelper $urlHelper
     */
    public function __construct(CommandBus $commandBus, MessageFactory $commandFactory, ServerUrlHelper $urlHelper)
    {
        $this->commandBus = $commandBus;
        $this->commandFactory = $commandFactory;
        $this->urlHelper = $urlHelper;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable $out
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $out = null
    ) : ResponseInterface {
        
        $data = $request->getParsedBody();
        $data['product_id'] = Uuid::uuid4()->toString();
        $data['owner_id'] = Uuid::uuid4()->toString();
        
        $images = [];
        if(!empty($request->getUploadedFiles()['product_images'])){
            $imagesRequest = $request->getUploadedFiles()['product_images'];
            foreach($imagesRequest as $key => $val){
                $filename = sprintf(
                                '%s.%s',
                                 Uuid::uuid4()->toString(),
                                pathinfo($val->getClientFilename(), PATHINFO_EXTENSION)
                            );
                if($filePath = $val->moveTo('public/upload/images/'.$filename)){
                    $images[$key] = 'public/upload/images/'.$filename.'';
                }
            }
        }
        $data['product_images']  = $images;
        $data['product_features'] = explode(',',$data['product_features']);
        
        $command = $this->commandFactory->createMessageFromArray(
            AddProductToDatabase::class,[
                'payload' => $data
            ]);
        $this->commandBus->dispatch($command);
        
        return new RedirectResponse($this->urlHelper->generate('/user-add-product'));
    }
}
