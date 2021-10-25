<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526190747 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function  isTransactional(): bool
    {
        return false;
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prof_tuteur_classe (prof_tuteur_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_B80398D92B210DFC (prof_tuteur_id), INDEX IDX_B80398D98F5EA509 (classe_id), PRIMARY KEY(prof_tuteur_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prof_tuteur_classe ADD CONSTRAINT FK_B80398D92B210DFC FOREIGN KEY (prof_tuteur_id) REFERENCES prof_tuteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_tuteur_classe ADD CONSTRAINT FK_B80398D98F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_tuteur DROP FOREIGN KEY FK_C0594B668F5EA509');
        $this->addSql('DROP INDEX IDX_C0594B668F5EA509 ON prof_tuteur');
        $this->addSql('ALTER TABLE prof_tuteur DROP classe_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE prof_tuteur_classe');
        $this->addSql('ALTER TABLE prof_tuteur ADD classe_id INT NOT NULL');
        $this->addSql('ALTER TABLE prof_tuteur ADD CONSTRAINT FK_C0594B668F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_C0594B668F5EA509 ON prof_tuteur (classe_id)');
    }
}
