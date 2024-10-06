<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AnggotaEkstrakurikuler extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ekstrakurikuler_id' => [
                'type' => 'INT',
                'null' => true,
            ],
            'student_id' => [
                'type' => 'INT',
                'null' => true,
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
        $this->forge->createTable('anggotaekstrakurikulers');
    }

    public function down()
    {
        $this->forge->dropTable('anggotaekstrakurikulers');
    }
}
