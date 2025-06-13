<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTimbanganTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'transaksi_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tgl_transaksi' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'hs_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'status_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'berat_timbangan' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
            'rfid_tanaman' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'group_id' => [ // Add the new group_id column
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('transaksi_id', true);
        $this->forge->addForeignKey('hs_id', 'hectare_statement', 'hs_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_id', 'status', 'status_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('group_id', 'group_karyawan', 'group_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('timbangan');
    }

    public function down()
    {
        $this->forge->dropTable('timbangan');
    }
}
