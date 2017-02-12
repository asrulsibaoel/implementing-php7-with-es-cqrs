<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use App\Projection\Table;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170212232114 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $kategori = $schema->createTable(Table::CATEGORY);
        $kategori->addColumn('category_id', 'string', ['length' => 36]);
        $kategori->addColumn('name', 'string', ['length' => 30]);
        $kategori->setPrimaryKey(['category_id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable(Table::CATEGORY);
    }
}
