<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('kelas');

        // Insert initial data
        $data = [
            ['name' => 'KB AMANAH'],
            ['name' => 'KB FATHONAH'],
            ['name' => 'KELOMPOK A1'],
            ['name' => 'KELOMPOK A2'],
            ['name' => 'KELOMPOK A3'],
            ['name' => 'KELOMPOK B1'],
            ['name' => 'KELOMPOK B2'],
            ['name' => 'KELOMPOK B3'],
        ];

        $this->db->table('kelas')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('kelas');
    }
}
