<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterLossesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'losses_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
                'null' => true,
            ],
            'penyebab_losses' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('losses_id', true);
        $this->forge->createTable('master_losses');
    }

    public function down()
    {
        $this->forge->dropTable('master_losses');
    }
}
