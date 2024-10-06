<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'position' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'role' => [
                'type' => 'INT',
            ],
            'avatar' => [
                'type' => 'TEXT',
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
        $this->forge->addKey('id', true); //fungsi ini menambahkan sebuah primary key pada kolom 'id' di tabel 'users'

        $this->forge->createTable('users'); //fungsi ini akan mengeksekusi perintah untuk benar2 membuat tabel 'users' di database
    }

    public function down()
    {
        $this->forge->dropTable('users'); //untuk menghapus tabel 'users' dari database
    }
}
