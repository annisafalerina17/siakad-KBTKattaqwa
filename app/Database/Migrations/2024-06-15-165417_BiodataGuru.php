<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BiodataGuru extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'teacher_id'       => [
                'type'       => 'INT',
                'null' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'nik' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'education' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'avatar' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'nuptk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'nrg' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'employee_status' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'position' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'institution' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'npsn' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'school_address' => [
                'type' => 'TEXT',
                'null' => true
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
        $this->forge->createTable('biodatagurus');
    }

    public function down()
    {
        $this->forge->dropTable('biodatagurus');
    }
}
