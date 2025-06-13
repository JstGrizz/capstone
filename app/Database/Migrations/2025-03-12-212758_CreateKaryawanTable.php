<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKaryawanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'karyawan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'npk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['L', 'P'],
                'null' => true,
            ],
            'golongan' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'tgl_lahir' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tgl_join' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tgl_termination' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'QRCode' => [
                'type' => 'BLOB',
                'null' => true,
            ],
            'status_karyawan' => [
                'type' => 'ENUM',
                'constraint' => ['tetap', 'harian lepas'],
            ],
            'lokasi_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ]
        ]);

        // Set 'karyawan_id' as the new primary key
        $this->forge->addKey('karyawan_id', true);

        // Make 'npk' a unique field
        $this->forge->addUniqueKey('npk');

        // Add foreign key to 'master_lokasi' table
        $this->forge->addForeignKey('lokasi_id', 'master_lokasi', 'lokasi_id', 'SET NULL', 'CASCADE');

        // Create 'karyawan' table
        $this->forge->createTable('karyawan');
    }

    public function down()
    {
        $this->forge->dropTable('karyawan');
    }
}
