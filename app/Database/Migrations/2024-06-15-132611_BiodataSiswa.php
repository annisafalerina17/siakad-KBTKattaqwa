<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BiodataSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id'       => [
                'type'       => 'INT',
                'null' => true
            ],
            'nisn' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'call' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'birthday' => [
                'type' => 'DATE',
                'null' => true
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'nth_child' => [
                'type' => 'INT',
                'null' => true
            ],
            'siblings' => [
                'type' => 'INT',
                'null' => true
            ],
            'religion' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'avatar' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'fathers_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'mothers_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'fathers_phone' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'mothers_phone' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'fathers_birthday' => [
                'type' => 'DATE',
                'null' => true
            ],
            'mothers_birthday' => [
                'type' => 'DATE',
                'null' => true
            ],
            'fathers_nik' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'mothers_nik' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'fathers_edu' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'mothers_edu' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'fathers_occupation' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'mothers_occupation' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'fathers_income' => [
                'type' => 'BIGINT',
                'null' => true
            ],
            'mothers_income' => [
                'type' => 'BIGINT',
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
        $this->forge->createTable('biodatasiswas');
    }

    public function down()
    {
        $this->forge->dropTable('biodatasiswas');
    }
}
