<?php
declare(strict_types=1);

namespace AppTest\Module\Product\Model;

use App\Module\Product\Model\Event\ProductWasAddedToDatabase;
use App\Module\Product\Model\Event\ProductWasMarkedSold;
use App\Module\Product\Model\ImageList;
use App\Module\Product\Model\ProductCategory;
use App\Module\Product\Model\ProductFeatures;
use App\Module\Product\Model\ProductId;
use App\Module\Product\Model\ProductPrice;
use App\Module\Product\Model\ProductStatus;
use App\Module\User\Model\UserId;
use App\Module\Product\Model\Product;
use AppTest\Base;

class ProductTest extends Base
{
    /**
     * @test
     */
    public function it_can_add_product_to_database()
    {
        $productId = ProductId::generate();
        $ownerId = UserId::generate();
        $productName = 'Lazio 1999 Home Jersey';
        $productDescription = 'Original jersey with player signature';
        $productCategory = ProductCategory::fromString('Fashion');
        $productFeatures = ProductFeatures::fromArray([
            'Hernan Crespo signature',
            'Original from 1999 when Lazio won scudetto',
            'Worn by Hernan Crespo in last Serie A game'
        ]);
        $productImages = ImageList::fromArray([
            '/tmp/front.jpg',
            '/tmp/back.jpg'
        ]);
        $productPrice = ProductPrice::fromString('100 USD');
        $productStatus = ProductStatus::unsold();

        $product = Product::addWithData(
            $productId,
            $ownerId,
            $productName,
            $productDescription,
            $productCategory,
            $productFeatures,
            $productImages,
            $productPrice,
            $productStatus
        );

        $event = $this->popRecordedEvent($product);

        $this->assertEquals(1, count($event));

        $this->assertInstanceOf(ProductWasAddedToDatabase::class, $event[0]);

        $this->assertTrue($productId->sameValueAs($event[0]->productId()));
        $this->assertTrue($ownerId->sameValueAs($event[0]->ownerId()));
        $this->assertEquals($event[0]->productName(), $productName);
        $this->assertEquals($event[0]->productDescription(), $productDescription);
        $this->assertTrue($productCategory->sameValueAs($event[0]->productCategory()));
        $this->assertTrue($productFeatures->sameValueAs($event[0]->productFeatures()));
        $this->assertTrue($productImages->sameValueAs($event[0]->productImages()));
        $this->assertTrue($productPrice->sameValueAs($event[0]->productPrice()));
        $this->assertTrue($productStatus->sameValueAs($event[0]->productStatus()));
    }

    /**
     * @test
     */
    public function it_can_mark_product_as_sold()
    {
        $productId = ProductId::generate();
        $ownerId = UserId::generate();
        $productName = 'Lazio 1999 Home Jersey';
        $productDescription = 'Original jersey with player signature';
        $productCategory = ProductCategory::fromString('Fashion');
        $productFeatures = ProductFeatures::fromArray([
            'Hernan Crespo signature',
            'Original from 1999 when Lazio won scudetto',
            'Worn by Hernan Crespo in last Serie A game'
        ]);
        $productImages = ImageList::fromArray([
            '/tmp/front.jpg',
            '/tmp/back.jpg'
        ]);
        $productPrice = ProductPrice::fromString('100 USD');
        $productStatus = ProductStatus::unsold();

        $product = Product::addWithData(
            $productId,
            $ownerId,
            $productName,
            $productDescription,
            $productCategory,
            $productFeatures,
            $productImages,
            $productPrice,
            $productStatus
        );

        $product->markAsSold();

        $event = $this->popRecordedEvent($product);

        $this->assertEquals(2, count($event));

        $this->assertInstanceOf(ProductWasMarkedSold::class, $event[1]);

        $this->assertTrue($product->productStatus()->sameValueAs(ProductStatus::sold()));
    }
}
