<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Module\User\Model\Command;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

/**
 * Description of SaveNewPassword
 *
 * @author asrulsibaoel
 */
final class ForgotPassword extends Command implements PayloadConstructable
{

    use PayloadTrait;

    public static function withData(string $userId, string $password) : SaveNewPassword
    {
        return new self([
            'user_id' => $userId,
            'password' => $password
        ]);
    }
    
    public function userId() : string
    {
        return $this->payload['userId'];
    }
    
    public function password() : string
    {
        return $this->payload['password'];
    }

}
