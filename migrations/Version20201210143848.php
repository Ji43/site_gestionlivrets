<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210143848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livret ADD periode_id INT NOT NULL');
        $this->addSql('ALTER TABLE livret ADD CONSTRAINT FK_C151207F384C1CF FOREIGN KEY (periode_id) REFERENCES periode (id)');
        $this->addSql('CREATE INDEX IDX_C151207F384C1CF ON livret (periode_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livret DROP FOREIGN KEY FK_C151207F384C1CF');
        $this->addSql('DROP INDEX IDX_C151207F384C1CF ON livret');
        $this->addSql('ALTER TABLE livret DROP periode_id');
    }
}
