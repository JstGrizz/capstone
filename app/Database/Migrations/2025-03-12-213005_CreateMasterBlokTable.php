<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterBlokTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'blok_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_blok' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'pt_estate_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('blok_id', true);
        $this->forge->addForeignKey('pt_estate_id', 'pt_estate', 'pt_estate_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('master_blok');
    }

    public function down()
    {
        $this->forge->dropTable('master_blok');
    }
}
