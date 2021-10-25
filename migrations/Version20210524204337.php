<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524204337 extends AbstractMigration
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
        $this->addSql('CREATE TABLE administrateur (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, nom_classe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, prenom VARCHAR(180) NOT NULL, nom_utilisateur VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, type_compte VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CFF65260D37CC8AC (nom_utilisateur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, tel VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT NOT NULL, classe_id INT NOT NULL, mail VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, INDEX IDX_717E22E38F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_suivi (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, comp_trans LONGTEXT DEFAULT NULL, comp_tech LONGTEXT DEFAULT NULL, obs_form LONGTEXT DEFAULT NULL, obs_app LONGTEXT DEFAULT NULL, obs_ma LONGTEXT DEFAULT NULL, missions LONGTEXT DEFAULT NULL, message_ent LONGTEXT DEFAULT NULL, rep_form LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_entreprise (formation_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_F5B129595200282E (formation_id), INDEX IDX_F5B12959A4AEAFEA (entreprise_id), PRIMARY KEY(formation_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livret (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, etudiant_id INT NOT NULL, maitre_apprentissage_id INT DEFAULT NULL, prof_tuteur_id INT DEFAULT NULL, periode_id INT NOT NULL, nom_livret VARCHAR(255) NOT NULL, INDEX IDX_C1512075200282E (formation_id), INDEX IDX_C151207DDEAB1A3 (etudiant_id), INDEX IDX_C151207FE8E47BA (maitre_apprentissage_id), INDEX IDX_C1512072B210DFC (prof_tuteur_id), INDEX IDX_C151207F384C1CF (periode_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maitre_apprentissage (id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_FC0B595DA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE periode (id INT AUTO_INCREMENT NOT NULL, annee1 VARCHAR(4) NOT NULL, annee2 VARCHAR(4) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prof_tuteur (id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_C0594B668F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrateur ADD CONSTRAINT FK_32EB52E8BF396750 FOREIGN KEY (id) REFERENCES compte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E38F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3BF396750 FOREIGN KEY (id) REFERENCES compte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_entreprise ADD CONSTRAINT FK_F5B129595200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_entreprise ADD CONSTRAINT FK_F5B12959A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livret ADD CONSTRAINT FK_C1512075200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE livret ADD CONSTRAINT FK_C151207DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE livret ADD CONSTRAINT FK_C151207FE8E47BA FOREIGN KEY (maitre_apprentissage_id) REFERENCES maitre_apprentissage (id)');
        $this->addSql('ALTER TABLE livret ADD CONSTRAINT FK_C1512072B210DFC FOREIGN KEY (prof_tuteur_id) REFERENCES prof_tuteur (id)');
        $this->addSql('ALTER TABLE livret ADD CONSTRAINT FK_C151207F384C1CF FOREIGN KEY (periode_id) REFERENCES periode (id)');
        $this->addSql('ALTER TABLE maitre_apprentissage ADD CONSTRAINT FK_FC0B595DA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE maitre_apprentissage ADD CONSTRAINT FK_FC0B595DBF396750 FOREIGN KEY (id) REFERENCES compte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prof_tuteur ADD CONSTRAINT FK_C0594B668F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE prof_tuteur ADD CONSTRAINT FK_C0594B66BF396750 FOREIGN KEY (id) REFERENCES compte (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E38F5EA509');
        $this->addSql('ALTER TABLE prof_tuteur DROP FOREIGN KEY FK_C0594B668F5EA509');
        $this->addSql('ALTER TABLE administrateur DROP FOREIGN KEY FK_32EB52E8BF396750');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3BF396750');
        $this->addSql('ALTER TABLE maitre_apprentissage DROP FOREIGN KEY FK_FC0B595DBF396750');
        $this->addSql('ALTER TABLE prof_tuteur DROP FOREIGN KEY FK_C0594B66BF396750');
        $this->addSql('ALTER TABLE formation_entreprise DROP FOREIGN KEY FK_F5B12959A4AEAFEA');
        $this->addSql('ALTER TABLE maitre_apprentissage DROP FOREIGN KEY FK_FC0B595DA4AEAFEA');
        $this->addSql('ALTER TABLE livret DROP FOREIGN KEY FK_C151207DDEAB1A3');
        $this->addSql('ALTER TABLE formation_entreprise DROP FOREIGN KEY FK_F5B129595200282E');
        $this->addSql('ALTER TABLE livret DROP FOREIGN KEY FK_C1512075200282E');
        $this->addSql('ALTER TABLE livret DROP FOREIGN KEY FK_C151207FE8E47BA');
        $this->addSql('ALTER TABLE livret DROP FOREIGN KEY FK_C151207F384C1CF');
        $this->addSql('ALTER TABLE livret DROP FOREIGN KEY FK_C1512072B210DFC');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE fiche_suivi');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_entreprise');
        $this->addSql('DROP TABLE livret');
        $this->addSql('DROP TABLE maitre_apprentissage');
        $this->addSql('DROP TABLE periode');
        $this->addSql('DROP TABLE prof_tuteur');
    }
}
