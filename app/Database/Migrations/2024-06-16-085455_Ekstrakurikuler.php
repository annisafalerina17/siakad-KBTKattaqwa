<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ekstrakurikuler extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'coach'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'day' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'time_start' => [
                'type' => 'TIME',
            ],
            'time_end' => [
                'type' => 'TIME',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ekstrakurikulers');
    }

    public function down()
    {
        $this->forge->dropTable('ekstrakurikulers');
    }
}
