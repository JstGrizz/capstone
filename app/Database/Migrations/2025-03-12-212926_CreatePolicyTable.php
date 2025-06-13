<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePolicyTable extends Migration
{
    public function up()
    {
        $sql = "CREATE TABLE `policy` (
        `policy_id` INT UNSIGNED AUTO_INCREMENT,
        `deskripsi` VARCHAR(255) NOT NULL,
        `satuan` VARCHAR(50) NOT NULL,
        `lama` INT NULL,
        `akhir` DATETIME NULL,
        `baru` INT NULL,
        `start` DATETIME NULL,
        `last_updated` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`policy_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $this->db->query($sql);
    }

    public function down()
    {
        $this->db->query("DROP TABLE `policy`");
    }
}
