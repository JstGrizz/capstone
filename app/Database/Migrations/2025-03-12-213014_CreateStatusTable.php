<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStatusTable extends Migration
{
    public function up()
    {
        $sql = "CREATE TABLE `status` (
            `status_id` INT UNSIGNED AUTO_INCREMENT,
            `nama_status` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`status_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $this->db->query($sql);
    }

    public function down()
    {
        $this->db->query("DROP TABLE `status`");
    }
}
