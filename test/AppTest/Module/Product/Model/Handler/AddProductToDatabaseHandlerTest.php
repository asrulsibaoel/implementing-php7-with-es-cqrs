<?php
declare(strict_types=1);

namespace AppTest\Module\Product\Model;

use App\Module\Product\Model\Command\AddProductToDatabase;
use App\Module\Product\Model\Handler\AddProductToDatabaseHandler;
use App\Module\Product\Model\ProductId;
use App\Module\User\Model\UserId;
use AppTest\Base;
use App\Module\Product\Model\ProductCollection;

class AddProductToDatabaseHandlerTest extends Base
{
    /**
     * @test
     */
    public function it_should_handle_command()
    {
        $productCollection = $this->prophesize(ProductCollection::class);
        $productCollection->add($this->anything());

        $handler = new AddProductToDatabaseHandler($productCollection->reveal());

        $data = [
            'product_id' => ProductId::generate()->toString(),
            'owner_id' => UserId::generate()->toString(),
            'product_name' => 'Lazio Jersey',
            'product_description' => 'Lazio Jersey',
            'product_category' => 'Mobil',
            'product_features' => [
                'Worn by Hernan Crespo',
                'Signature by Hernan Crespo'
            ],
            'product_images' => [
                '/tmp/front.jpg',
                '/tmp/back.jpg'
            ],
            'amount' => 100,
            'currency' => 'USD'
        ];

        $command = new AddProductToDatabase($data);

        $handler($command);
    }
}
