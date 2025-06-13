<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterLokasiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'lokasi_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('lokasi_id', true);
        $this->forge->addUniqueKey('nama_lokasi');
        $this->forge->createTable('master_lokasi');
    }

    public function down()
    {
        $this->forge->dropTable('master_lokasi');
    }
}
