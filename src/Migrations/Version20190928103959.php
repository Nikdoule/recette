<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190928103959 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE avis (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, commentaire CLOB NOT NULL, note INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE etapes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contenu CLOB NOT NULL)');
        $this->addSql('CREATE TABLE ingredients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, quantite INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE recettes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, etape_id INTEGER DEFAULT NULL, avi_id INTEGER DEFAULT NULL, titre VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, temps_de_preparation INTEGER NOT NULL, temps_de_cuisson INTEGER NOT NULL, prix INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_EB48E72C4A8CA2AD ON recettes (etape_id)');
        $this->addSql('CREATE INDEX IDX_EB48E72CDBD6CC98 ON recettes (avi_id)');
        $this->addSql('CREATE TABLE recettes_ustensiles (recettes_id INTEGER NOT NULL, ustensiles_id INTEGER NOT NULL, PRIMARY KEY(recettes_id, ustensiles_id))');
        $this->addSql('CREATE INDEX IDX_10BA87463E2ED6D6 ON recettes_ustensiles (recettes_id)');
        $this->addSql('CREATE INDEX IDX_10BA8746E470D56B ON recettes_ustensiles (ustensiles_id)');
        $this->addSql('CREATE TABLE recettes_ingredients (recettes_id INTEGER NOT NULL, ingredients_id INTEGER NOT NULL, PRIMARY KEY(recettes_id, ingredients_id))');
        $this->addSql('CREATE INDEX IDX_33E6DB8E3E2ED6D6 ON recettes_ingredients (recettes_id)');
        $this->addSql('CREATE INDEX IDX_33E6DB8E3EC4DCE ON recettes_ingredients (ingredients_id)');
        $this->addSql('CREATE TABLE recettes_tag (recettes_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(recettes_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_7D386273E2ED6D6 ON recettes_tag (recettes_id)');
        $this->addSql('CREATE INDEX IDX_7D38627BAD26311 ON recettes_tag (tag_id)');
        $this->addSql('CREATE TABLE tag (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE ustensiles (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE etapes');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE recettes');
        $this->addSql('DROP TABLE recettes_ustensiles');
        $this->addSql('DROP TABLE recettes_ingredients');
        $this->addSql('DROP TABLE recettes_tag');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE ustensiles');
    }
}
