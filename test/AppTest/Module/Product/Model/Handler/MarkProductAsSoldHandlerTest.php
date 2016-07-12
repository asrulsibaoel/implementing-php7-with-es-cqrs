<?php


namespace AppTest\Module\Product\Model;

use App\Module\Product\Model\Command\MarkProductAsSold;
use App\Module\Product\Model\Handler\MarkProductAsSoldHandler;
use App\Module\Product\Model\ProductCollection;
use App\Module\Product\Model\Product;
use App\Module\Product\Model\ProductId;
use AppTest\Base;

class MarkProductAsSoldHandlerTest extends Base
{
    /**
     * @test
     */
    public function it_should_handle_command()
    {
        $productId = ProductId::generate();
        $command = MarkProductAsSold::withData($productId);

        $productCollection = $this->prophesize(ProductCollection::class);
        $product = $this->prophesize(Product::class);
        $product->markAsSold()->shouldBeCalled();
        $productCollection->get($productId)->willReturn($product->reveal());

        $handler = new MarkProductAsSoldHandler($productCollection->reveal());

        $handler($command);
    }

    /**
     * @test
     * @expectedException \App\Module\Product\Model\Exception\ProductNotFound
     */
    public function it_should_throw_exception_when_product_not_found()
    {
        $productId = ProductId::generate();
        $command = MarkProductAsSold::withData($productId);

        $productCollection = $this->prophesize(ProductCollection::class);
        $productCollection->get($productId)->willReturn(null);

        $handler = new MarkProductAsSoldHandler($productCollection->reveal());

        $handler($command);
    }
}
