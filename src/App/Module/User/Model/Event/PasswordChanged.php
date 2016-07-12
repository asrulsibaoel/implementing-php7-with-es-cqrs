<?php
/**
 * Description of PasswordChanged
 *
 * @author asrulsibaoel
 */

namespace App\Module\User\Model\Event;

use Prooph\EventSourcing\AggregateChanged;


final class PasswordChanged extends AggregateChanged
{
    /**
     *
     * @var string 
     */
    private $userId;
    
    /**
     *
     * @var string
     */
    private $password;
    
    public static function withData(string $userId, string $password) : PasswordChanged
    {
        $event = self::occur($userId,[
            'password' => $password
        ]);
        
        $event->userId = $userId;
        $event->password = $password;
        
        return $event;
    }
    
    public function userId() : string
    {
        if (is_null($this->userId)) {
            $this->userId = $this->payload['userId'];
        }

        return $this->password;
    }
    
    public function password() : string
    {
        if (is_null($this->password)) {
            $this->password = $this->payload['password'];
        }

        return $this->password;
    }
}
