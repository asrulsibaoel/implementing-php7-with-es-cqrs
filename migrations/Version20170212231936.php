<?php

namespace App\Migrations;

use App\Projection\Table;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;


/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170212231936 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        // this up() migration is auto-generated, please modify it to your needs
        $user = $schema->createTable(Table::USER);

        $user->addColumn('user_id', 'string', ['length' => 36]);
        $user->addColumn('nama', 'string', [
            'length' => 40,
        ])->setNotnull(false);
        $user->addColumn('email', 'string', ['length' => 30]);
        $user->addColumn('username', 'string', ['length' => 30])->setNotnull(false);
        $user->addColumn('password', 'string', ['length' => 64]);
        $user->addColumn('role', 'integer', ['length' => 2])->setNotnull(false);
        $user->addColumn('phone', 'integer', ['length' => 12])->setNotnull(false);
        $user->addColumn('address', 'string', ['length' => 50])->setNotnull(false);
        $user->setPrimaryKey(['user_id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable(Table::USER);
    }
}
