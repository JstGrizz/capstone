<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGroupKaryawanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'group_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_group' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'tipe_group' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'lokasi_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ]
        ]);
        $this->forge->addKey('group_id', true);
        $this->forge->addForeignKey('lokasi_id', 'master_lokasi', 'lokasi_id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('group_karyawan');
    }

    public function down()
    {
        $this->forge->dropTable('group_karyawan');
    }
}
