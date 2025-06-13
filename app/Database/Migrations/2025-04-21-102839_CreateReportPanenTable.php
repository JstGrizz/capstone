<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReportPanenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'transaksi_id' => [
                'type' => 'INT',
                'unsigned' => true,
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
            'group_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);  // Set 'id' as primary key
        $this->forge->addForeignKey('transaksi_id', 'timbangan', 'transaksi_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('hs_id', 'hectare_statement', 'hs_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_id', 'status', 'status_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('group_id', 'group_karyawan', 'group_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('report_panen');  // Create the 'report_panen' table
    }

    public function down()
    {
        $this->forge->dropTable('report_panen');
    }
}
