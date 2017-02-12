<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use App\Projection\Table;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170212232028 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $kota = $schema->createTable(Table::CITY);

        $kota->addColumn('city_id', 'string', ['length' => 36]);
        $kota->addColumn('city', 'string', ['length' => 50]);
        $kota->addColumn('state', 'string', ['length' => 50]);
        $kota->setPrimaryKey(['city_id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable(Table::CITY);
    }
}
