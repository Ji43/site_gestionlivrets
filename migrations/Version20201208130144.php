<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208130144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation_entreprise (formation_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_F5B129595200282E (formation_id), INDEX IDX_F5B12959A4AEAFEA (entreprise_id), PRIMARY KEY(formation_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation_entreprise ADD CONSTRAINT FK_F5B129595200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_entreprise ADD CONSTRAINT FK_F5B12959A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE etudiant_formation');
        $this->addSql('DROP TABLE etudiant_maitre_stage');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E32B210DFC');
        $this->addSql('DROP INDEX IDX_717E22E32B210DFC ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP prof_tuteur_id');
        $this->addSql('ALTER TABLE fiche_suivi DROP FOREIGN KEY FK_543C20B05200282E');
        $this->addSql('DROP INDEX IDX_543C20B05200282E ON fiche_suivi');
        $this->addSql('ALTER TABLE fiche_suivi DROP formation_id');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFA4AEAFEA');
        $this->addSql('DROP INDEX IDX_404021BFA4AEAFEA ON formation');
        $this->addSql('ALTER TABLE formation DROP entreprise_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etudiant_formation (etudiant_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_8ECBC4C8DDEAB1A3 (etudiant_id), INDEX IDX_8ECBC4C85200282E (formation_id), PRIMARY KEY(etudiant_id, formation_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE etudiant_maitre_stage (etudiant_id INT NOT NULL, maitre_stage_id INT NOT NULL, INDEX IDX_1A6F57F1DDEAB1A3 (etudiant_id), INDEX IDX_1A6F57F1ADCA9431 (maitre_stage_id), PRIMARY KEY(etudiant_id, maitre_stage_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE etudiant_formation ADD CONSTRAINT FK_8ECBC4C85200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant_formation ADD CONSTRAINT FK_8ECBC4C8DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant_maitre_stage ADD CONSTRAINT FK_1A6F57F1ADCA9431 FOREIGN KEY (maitre_stage_id) REFERENCES maitre_stage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant_maitre_stage ADD CONSTRAINT FK_1A6F57F1DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE formation_entreprise');
        $this->addSql('ALTER TABLE etudiant ADD prof_tuteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E32B210DFC FOREIGN KEY (prof_tuteur_id) REFERENCES prof_tuteur (id)');
        $this->addSql('CREATE INDEX IDX_717E22E32B210DFC ON etudiant (prof_tuteur_id)');
        $this->addSql('ALTER TABLE fiche_suivi ADD formation_id INT NOT NULL');
        $this->addSql('ALTER TABLE fiche_suivi ADD CONSTRAINT FK_543C20B05200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_543C20B05200282E ON fiche_suivi (formation_id)');
        $this->addSql('ALTER TABLE formation ADD entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_404021BFA4AEAFEA ON formation (entreprise_id)');
    }
}
