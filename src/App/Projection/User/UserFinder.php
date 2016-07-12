<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Projection\User;

use App\Projection\Table;
use Doctrine\DBAL\Connection;
use PDO;

/**
 * Description of UserFinder
 *
 * @author asrulsibaoel
 */
class UserFinder
{

    /**
     *
     * @var Connection $connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->connection->setFetchMode(PDO::FETCH_OBJ);
    }

    public function findAll()
    {
        return $this->connection->fetchAll(sprintf("SELECT * FROM %s", Table::USER));
    }

    function findById(string $userId)
    {
        $stmt = $this->connection->prepare(sprintf("SELECT * FROM %s where id= :user_id", Table::USER));
        $stmt->bindValue('user_id', $userId);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function findWhere($where = array())
    {
        foreach($where as $key => $val){
            
        }

        $stmt = $this->connection->prepare(sprintf("SELECT * FROM %s where id= :user_id", Table::USER));
        $stmt->bindValue('user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
