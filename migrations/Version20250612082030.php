<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250612082030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE lightnovel_genre (lightnovel_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_11787FD2E490EAA5 (lightnovel_id), INDEX IDX_11787FD24296D31F (genre_id), PRIMARY KEY(lightnovel_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lightnovel_genre ADD CONSTRAINT FK_11787FD2E490EAA5 FOREIGN KEY (lightnovel_id) REFERENCES lightnovel (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lightnovel_genre ADD CONSTRAINT FK_11787FD24296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lightnovel ADD genre VARCHAR(255) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE lightnovel_genre DROP FOREIGN KEY FK_11787FD2E490EAA5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lightnovel_genre DROP FOREIGN KEY FK_11787FD24296D31F
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE lightnovel_genre
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lightnovel DROP genre
        SQL);
    }
}
