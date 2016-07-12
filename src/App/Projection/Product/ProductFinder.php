<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Projection\Product;

use App\Projection\Table;
use Doctrine\DBAL\Connection;

/**
 * Description of ProductFinder
 *
 * @author asrulsibaoel
 */
final class ProductFinder
{

    /**
     *
     * @var Connection
     */
    private $connection;

    /**
     * 
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->connection->setFetchMode(\PDO::FETCH_OBJ);
    }

    public function findAll()
    {
        return $this->connection->fetchAll(sprintf("SELECT * FROM %s", Table::PRODUCT));
    }

    /**
     * 
     * @param string $string
     * @param array $condition
     */
    public function findWithCondition(string $string = '1=1', array $condition = array('1'=> '1'))
    {
        $implodedWhere = '';
        if (!empty($condition)) {
            foreach ($condition as $key => $val) {
                $implodedWhere .= $key.'="'.$val.'"';
            }
        }
        return $this->connection->fetchAll(sprintf("SELECT * FROM %s where ".$string.' AND '.$implodedWhere, Table::PRODUCT));
    }

    /**
     * 
     * @param int $start
     * @param int $end
     */
    public function findLimited($start, $end)
    {
        return $this->connection->fetchAll(sprintf("SELECT * FROM %s limit " . $start . ',' . $end, Table::PRODUCT));
    }

    /**
     * 
     * @param string $productId
     */
    public function findById($productId)
    {
        $stmt = $this->connection->prepare(sprintf("SELECT * FROM %s where id= :product_id", Table::PRODUCT));
        $stmt->bindValue('product_id', $productId);
        return $stmt->fetch();
    }

}
