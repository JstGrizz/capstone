<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHectareStatementTable extends Migration
{
    public function up()
    {
        $sql = "CREATE TABLE `hectare_statement` (
            `hs_id` INT UNSIGNED AUTO_INCREMENT,
            `luas_tanah` DECIMAL(10,2) NOT NULL,
            `tanggal_tanam` DATE NULL,
            `jumlah_pohon` INT NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `varian_bibit` VARCHAR(255) NULL,
            `tahun_tanam` YEAR NULL,
            `bulan_tanam` VARCHAR(255) NULL,
            `sph` DECIMAL(10,2) NULL,
            `blok_id` INT UNSIGNED NULL,
            `pt_estate_id` INT UNSIGNED NULL,
            PRIMARY KEY (`hs_id`),
            FOREIGN KEY (`blok_id`) REFERENCES `master_blok` (`blok_id`),
            FOREIGN KEY (`pt_estate_id`) REFERENCES `pt_estate` (`pt_estate_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $this->db->query($sql);
    }

    public function down()
    {
        $this->db->query("DROP TABLE `hectare_statement`");
    }
}
