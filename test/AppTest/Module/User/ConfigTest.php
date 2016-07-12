<?php

namespace AppTest\Module\User;

use App\Module\User\Config;
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
