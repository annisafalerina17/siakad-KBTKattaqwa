<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Laporanerkembangan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type' => 'INT',
                'null' => true,
            ],
            'semester' => [
                'type' => 'INT',
                'null' => true,
            ],
            'lppd' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'className' => [
                'type' => 'TEXT',
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
        $this->forge->createTable('laporanperkembangans');
    }

    public function down()
    {
        $this->forge->dropTable('laporanperkembangans');
    }
}
