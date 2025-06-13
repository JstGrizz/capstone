<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePtEstateTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pt_estate_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'pt' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'estate' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('pt_estate_id', true);
        $this->forge->createTable('pt_estate');
    }

    public function down()
    {
        $this->forge->dropTable('pt_estate');
    }
}
