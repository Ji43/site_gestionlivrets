<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211024202912 extends AbstractMigration
{
    public function isTransactional(): bool
    {
        return false;
    }

    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE prof_tuteur_classe');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prof_tuteur_classe (prof_tuteur_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_B80398D92B210DFC (prof_tuteur_id), INDEX IDX_B80398D98F5EA509 (classe_id), PRIMARY KEY(prof_tuteur_id, classe_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE prof_tuteur_classe ADD CONSTRAINT FK_B80398D92B210DFC FOREIGN KEY (prof_tuteur_id) REFERENCES prof_tuteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_tuteur_classe ADD CONSTRAINT FK_B80398D98F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
    }
}
