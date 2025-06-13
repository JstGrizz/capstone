<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoryLossesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'history_losses_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tanaman_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'tgl_mulai_identifikasi' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'hs_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'rfid_tanaman' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'latitude_tanam' => [
                'type' => 'DECIMAL',
                'constraint' => '10,8',
                'null' => true,
            ],
            'longitude_tanam' => [
                'type' => 'DECIMAL',
                'constraint' => '11,8',
                'null' => true,
            ],
            'no_titik_tanam' => [
                'type' => 'INT',
                'null' => true,
            ],
            'status_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'sister' => [
                'type' => 'INT',
                'null' => true,
            ],
            'is_loses' => [
                'type' => 'CHAR',
                'constraint' => '1',
                'default' => 'N',
            ],
            'losses_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'deskripsi_loses' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tgl_akhir_identifikasi' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'minggu' => [
                'type' => 'INT',
                'null' => false,
            ],
            'nama_karyawan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'npk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('history_losses_id', true);
        $this->forge->addForeignKey('tanaman_id', 'tanaman', 'tanaman_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('hs_id', 'hectare_statement', 'hs_id');
        $this->forge->addForeignKey('status_id', 'status', 'status_id');
        $this->forge->addForeignKey('losses_id', 'master_losses', 'losses_id');
        $this->forge->addForeignKey('npk', 'karyawan', 'npk');
        $this->forge->createTable('history_losses');
    }

    public function down()
    {
        $this->forge->dropTable('history_losses');
    }
}
