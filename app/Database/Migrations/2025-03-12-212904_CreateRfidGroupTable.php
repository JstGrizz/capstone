<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRfidGroupTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'rfid_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,  // Added auto_increment attribute
            ],
            'rfid' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,  // Allows NULL values
            ],
            'group_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,  // Added unsigned attribute
            ],
            'npk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'role_lapangan' => [
                'type' => 'ENUM',
                'constraint' => ['asisten', 'mandor', 'pekebun'],
            ]
        ]);
        $this->forge->addKey('rfid_id', true);
        $this->forge->addForeignKey('group_id', 'group_karyawan', 'group_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('npk', 'karyawan', 'npk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rfid_group');
    }

    public function down()
    {
        $this->forge->dropTable('rfid_group');
    }
}
