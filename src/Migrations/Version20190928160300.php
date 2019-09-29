<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190928160300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_4B60114FEC4A74AB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredients AS SELECT id, unite_id, nom, quantite FROM ingredients');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('CREATE TABLE ingredients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unite_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, quantite INTEGER NOT NULL, CONSTRAINT FK_4B60114FEC4A74AB FOREIGN KEY (unite_id) REFERENCES unites (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ingredients (id, unite_id, nom, quantite) SELECT id, unite_id, nom, quantite FROM __temp__ingredients');
        $this->addSql('DROP TABLE __temp__ingredients');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4B60114FEC4A74AB ON ingredients (unite_id)');
        $this->addSql('DROP INDEX IDX_EB48E72CDBD6CC98');
        $this->addSql('DROP INDEX IDX_EB48E72C4A8CA2AD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recettes AS SELECT id, etape_id, avi_id, titre, image, temps_de_preparation, temps_de_cuisson, prix FROM recettes');
        $this->addSql('DROP TABLE recettes');
        $this->addSql('CREATE TABLE recettes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, etape_id INTEGER DEFAULT NULL, avi_id INTEGER DEFAULT NULL, titre VARCHAR(255) NOT NULL COLLATE BINARY, image VARCHAR(255) NOT NULL COLLATE BINARY, temps_de_preparation INTEGER NOT NULL, temps_de_cuisson INTEGER NOT NULL, prix INTEGER NOT NULL, CONSTRAINT FK_EB48E72C4A8CA2AD FOREIGN KEY (etape_id) REFERENCES etapes (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_EB48E72CDBD6CC98 FOREIGN KEY (avi_id) REFERENCES avis (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO recettes (id, etape_id, avi_id, titre, image, temps_de_preparation, temps_de_cuisson, prix) SELECT id, etape_id, avi_id, titre, image, temps_de_preparation, temps_de_cuisson, prix FROM __temp__recettes');
        $this->addSql('DROP TABLE __temp__recettes');
        $this->addSql('CREATE INDEX IDX_EB48E72CDBD6CC98 ON recettes (avi_id)');
        $this->addSql('CREATE INDEX IDX_EB48E72C4A8CA2AD ON recettes (etape_id)');
        $this->addSql('DROP INDEX IDX_10BA8746E470D56B');
        $this->addSql('DROP INDEX IDX_10BA87463E2ED6D6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recettes_ustensiles AS SELECT recettes_id, ustensiles_id FROM recettes_ustensiles');
        $this->addSql('DROP TABLE recettes_ustensiles');
        $this->addSql('CREATE TABLE recettes_ustensiles (recettes_id INTEGER NOT NULL, ustensiles_id INTEGER NOT NULL, PRIMARY KEY(recettes_id, ustensiles_id), CONSTRAINT FK_10BA87463E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_10BA8746E470D56B FOREIGN KEY (ustensiles_id) REFERENCES ustensiles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO recettes_ustensiles (recettes_id, ustensiles_id) SELECT recettes_id, ustensiles_id FROM __temp__recettes_ustensiles');
        $this->addSql('DROP TABLE __temp__recettes_ustensiles');
        $this->addSql('CREATE INDEX IDX_10BA8746E470D56B ON recettes_ustensiles (ustensiles_id)');
        $this->addSql('CREATE INDEX IDX_10BA87463E2ED6D6 ON recettes_ustensiles (recettes_id)');
        $this->addSql('DROP INDEX IDX_33E6DB8E3EC4DCE');
        $this->addSql('DROP INDEX IDX_33E6DB8E3E2ED6D6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recettes_ingredients AS SELECT recettes_id, ingredients_id FROM recettes_ingredients');
        $this->addSql('DROP TABLE recettes_ingredients');
        $this->addSql('CREATE TABLE recettes_ingredients (recettes_id INTEGER NOT NULL, ingredients_id INTEGER NOT NULL, PRIMARY KEY(recettes_id, ingredients_id), CONSTRAINT FK_33E6DB8E3E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_33E6DB8E3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO recettes_ingredients (recettes_id, ingredients_id) SELECT recettes_id, ingredients_id FROM __temp__recettes_ingredients');
        $this->addSql('DROP TABLE __temp__recettes_ingredients');
        $this->addSql('CREATE INDEX IDX_33E6DB8E3EC4DCE ON recettes_ingredients (ingredients_id)');
        $this->addSql('CREATE INDEX IDX_33E6DB8E3E2ED6D6 ON recettes_ingredients (recettes_id)');
        $this->addSql('DROP INDEX IDX_7D38627BAD26311');
        $this->addSql('DROP INDEX IDX_7D386273E2ED6D6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recettes_tag AS SELECT recettes_id, tag_id FROM recettes_tag');
        $this->addSql('DROP TABLE recettes_tag');
        $this->addSql('CREATE TABLE recettes_tag (recettes_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(recettes_id, tag_id), CONSTRAINT FK_7D386273E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recettes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7D38627BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO recettes_tag (recettes_id, tag_id) SELECT recettes_id, tag_id FROM __temp__recettes_tag');
        $this->addSql('DROP TABLE __temp__recettes_tag');
        $this->addSql('CREATE INDEX IDX_7D38627BAD26311 ON recettes_tag (tag_id)');
        $this->addSql('CREATE INDEX IDX_7D386273E2ED6D6 ON recettes_tag (recettes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_4B60114FEC4A74AB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredients AS SELECT id, unite_id, nom, quantite FROM ingredients');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('CREATE TABLE ingredients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unite_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, quantite INTEGER NOT NULL)');
        $this->addSql('INSERT INTO ingredients (id, unite_id, nom, quantite) SELECT id, unite_id, nom, quantite FROM __temp__ingredients');
        $this->addSql('DROP TABLE __temp__ingredients');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4B60114FEC4A74AB ON ingredients (unite_id)');
        $this->addSql('DROP INDEX IDX_EB48E72C4A8CA2AD');
        $this->addSql('DROP INDEX IDX_EB48E72CDBD6CC98');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recettes AS SELECT id, etape_id, avi_id, titre, image, temps_de_preparation, temps_de_cuisson, prix FROM recettes');
        $this->addSql('DROP TABLE recettes');
        $this->addSql('CREATE TABLE recettes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, etape_id INTEGER DEFAULT NULL, avi_id INTEGER DEFAULT NULL, titre VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, temps_de_preparation INTEGER NOT NULL, temps_de_cuisson INTEGER NOT NULL, prix INTEGER NOT NULL)');
        $this->addSql('INSERT INTO recettes (id, etape_id, avi_id, titre, image, temps_de_preparation, temps_de_cuisson, prix) SELECT id, etape_id, avi_id, titre, image, temps_de_preparation, temps_de_cuisson, prix FROM __temp__recettes');
        $this->addSql('DROP TABLE __temp__recettes');
        $this->addSql('CREATE INDEX IDX_EB48E72C4A8CA2AD ON recettes (etape_id)');
        $this->addSql('CREATE INDEX IDX_EB48E72CDBD6CC98 ON recettes (avi_id)');
        $this->addSql('DROP INDEX IDX_33E6DB8E3E2ED6D6');
        $this->addSql('DROP INDEX IDX_33E6DB8E3EC4DCE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recettes_ingredients AS SELECT recettes_id, ingredients_id FROM recettes_ingredients');
        $this->addSql('DROP TABLE recettes_ingredients');
        $this->addSql('CREATE TABLE recettes_ingredients (recettes_id INTEGER NOT NULL, ingredients_id INTEGER NOT NULL, PRIMARY KEY(recettes_id, ingredients_id))');
        $this->addSql('INSERT INTO recettes_ingredients (recettes_id, ingredients_id) SELECT recettes_id, ingredients_id FROM __temp__recettes_ingredients');
        $this->addSql('DROP TABLE __temp__recettes_ingredients');
        $this->addSql('CREATE INDEX IDX_33E6DB8E3E2ED6D6 ON recettes_ingredients (recettes_id)');
        $this->addSql('CREATE INDEX IDX_33E6DB8E3EC4DCE ON recettes_ingredients (ingredients_id)');
        $this->addSql('DROP INDEX IDX_7D386273E2ED6D6');
        $this->addSql('DROP INDEX IDX_7D38627BAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recettes_tag AS SELECT recettes_id, tag_id FROM recettes_tag');
        $this->addSql('DROP TABLE recettes_tag');
        $this->addSql('CREATE TABLE recettes_tag (recettes_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(recettes_id, tag_id))');
        $this->addSql('INSERT INTO recettes_tag (recettes_id, tag_id) SELECT recettes_id, tag_id FROM __temp__recettes_tag');
        $this->addSql('DROP TABLE __temp__recettes_tag');
        $this->addSql('CREATE INDEX IDX_7D386273E2ED6D6 ON recettes_tag (recettes_id)');
        $this->addSql('CREATE INDEX IDX_7D38627BAD26311 ON recettes_tag (tag_id)');
        $this->addSql('DROP INDEX IDX_10BA87463E2ED6D6');
        $this->addSql('DROP INDEX IDX_10BA8746E470D56B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recettes_ustensiles AS SELECT recettes_id, ustensiles_id FROM recettes_ustensiles');
        $this->addSql('DROP TABLE recettes_ustensiles');
        $this->addSql('CREATE TABLE recettes_ustensiles (recettes_id INTEGER NOT NULL, ustensiles_id INTEGER NOT NULL, PRIMARY KEY(recettes_id, ustensiles_id))');
        $this->addSql('INSERT INTO recettes_ustensiles (recettes_id, ustensiles_id) SELECT recettes_id, ustensiles_id FROM __temp__recettes_ustensiles');
        $this->addSql('DROP TABLE __temp__recettes_ustensiles');
        $this->addSql('CREATE INDEX IDX_10BA87463E2ED6D6 ON recettes_ustensiles (recettes_id)');
        $this->addSql('CREATE INDEX IDX_10BA8746E470D56B ON recettes_ustensiles (ustensiles_id)');
    }
}
