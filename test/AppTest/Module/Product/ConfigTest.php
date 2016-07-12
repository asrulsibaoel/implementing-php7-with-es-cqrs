<?php


namespace AppTest\Module\Product;

use App\Module\Product\Config;
use AppTest\Base;

class ConfigTest extends Base
{
    /**
     * @test
     */
    public function it_should_return_array_config()
    {
        $config = new Config();

        $this->assertArrayHasKey('prooph', $config());
    }
}
