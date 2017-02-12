<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use App\Projection\Table;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170212232158 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $konten = $schema->createTable(Table::CONTENT);
        $konten->addColumn('content_id', 'string', ['length' => 36]);
        $konten->addColumn('title', 'string', ['length' => 30]);
        $konten->addColumn('detail', 'text', []);
        $konten->addColumn('date', 'datetime');
        $konten->addColumn('price', 'integer', ['length' => 30]);
        $konten->addColumn('category_id', 'string', ['length' => 36]);
        $konten->addColumn('user_id', 'string', ['length' => 36]);
        $konten->addColumn('media', 'text', []);
        $konten->setPrimaryKey(['content_id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable(Table::CONTENT);
    }
}
