<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629095304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE freelancer ADD collaboration_id INT DEFAULT NULL, ADD username VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, CHANGE nom password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE freelancer ADD CONSTRAINT FK_4C2ED1E8EF1544CE FOREIGN KEY (collaboration_id) REFERENCES offre (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C2ED1E8F85E0677 ON freelancer (username)');
        $this->addSql('CREATE INDEX IDX_4C2ED1E8EF1544CE ON freelancer (collaboration_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE freelancer DROP FOREIGN KEY FK_4C2ED1E8EF1544CE');
        $this->addSql('DROP INDEX UNIQ_4C2ED1E8F85E0677 ON freelancer');
        $this->addSql('DROP INDEX IDX_4C2ED1E8EF1544CE ON freelancer');
        $this->addSql('ALTER TABLE freelancer DROP collaboration_id, DROP username, DROP roles, CHANGE password nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
