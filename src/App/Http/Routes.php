<?php
namespace App\Http;

use App\Http\Action\HomePageAction;
use App\Http\Action\LoginAction;
use App\Http\Action\MultiPurposeAction;
use App\Http\Action\ProductDetailAction;
use App\Http\Action\ProductListingAction;
use App\Http\Action\RegisteredUserAction;
use App\Http\Action\RegisterFormAction;
use App\Http\Action\RegisterUserAction;
use App\Http\Action\UserAddProductAction;
use App\Http\Action\UserAddProductRecordAction;
use App\Http\Action\UserProductListingAction;
use App\Http\Container\HomePageActionFactory;
use App\Http\Container\LoginActionFactory;
use App\Http\Container\MultiPurposeActionFactory;
use App\Http\Container\ProductDetailActionFactory;
use App\Http\Container\ProductListingActionFactory;
use App\Http\Container\RegisteredUserActionFactory;
use App\Http\Container\RegisterFormActionFactory;
use App\Http\Container\RegisterUserActionFactory;
use App\Http\Container\UserAddProductActionFactory;
use App\Http\Container\UserAddProductRecordActionFactory;
use App\Http\Container\UserProductListingActionFactory;

class Routes
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    HomePageAction::class => HomePageActionFactory::class,
                    RegisterUserAction::class => RegisterUserActionFactory::class,
                    RegisterFormAction::class => RegisterFormActionFactory::class,
                    RegisteredUserAction::class => RegisteredUserActionFactory::class,
                    LoginAction::class => LoginActionFactory::class,
                    MultiPurposeAction::class => MultiPurposeActionFactory::class,
                    ProductDetailAction::class => ProductDetailActionFactory::class,
                    ProductListingAction::class => ProductListingActionFactory::class,
                    UserAddProductAction::class => UserAddProductActionFactory::class,
                    UserAddProductRecordAction::class => UserAddProductRecordActionFactory::class,
                    UserProductListingAction::class => UserProductListingActionFactory::class,
                ],
            ],
            'routes' => [
                [
                    'name' => 'home',
                    'path' => '/',
                    'middleware' => HomePageAction::class,
                    'allowed_methods' => ['GET'],
                ],
                [
                    'name' => 'register-user',
                    'path' => '/register',
                    'middleware' => RegisterUserAction::class,
                    'allowed_methods' => ['POST']
                ],
                [
                    'name' => 'register-form',
                    'path' => '/register-form',
                    'middleware' => RegisterFormAction::class,
                    'allowed_methods' => ['GET']
                ],
                [
                    'name' => 'registered-user',
                    'path' => '/registered',
                    'middleware' => RegisteredUserAction::class,
                    'allowed_methods' => ['GET']
                ],
                [
                    'name' => 'login',
                    'path' => '/login',
                    'middleware' => LoginAction::class,
                    'allowed_methods' => ['GET']
                ],
                [
                    'name' => 'multi-purpose',
                    'path' => '/multi-purpose',
                    'middleware' => MultiPurposeAction::class,
                    'allowed_methods' => ['GET']
                ],
                [
                    'name' => 'product-detail',
                    'path' => '/product-detail',
                    'middleware' => ProductDetailAction::class,
                    'allowed_methods' => ['GET']
                ],
                [
                    'name' => 'product-listing',
                    'path' => '/product-listing',
                    'middleware' => ProductListingAction::class,
                    'allowed_methods' => ['GET']
                ],
                [
                    'name' => 'user-add-product',
                    'path' => '/user-add-product',
                    'middleware' => UserAddProductAction::class,
                    'allowed_methods' => ['GET']
                ],
                [
                    'name' => 'user-add-product-record',
                    'path' => '/user-add-product-record',
                    'middleware' => UserAddProductRecordAction::class,
                    'allowed_methods' => ['POST']
                ],
                [
                    'name' => 'user-product-listing',
                    'path' => '/user-product-listing',
                    'middleware' => UserProductListingAction::class,
                    'allowed_methods' => ['GET']
                ],
            ],
        ];
    }
}
