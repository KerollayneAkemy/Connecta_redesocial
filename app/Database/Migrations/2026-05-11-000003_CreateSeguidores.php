<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSeguidores extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'seguidor_id' => [
                'type' => 'INT'
            ],
            'seguido_id' => [
                'type' => 'INT'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('seguidores', true); // TRUE means "IF NOT EXISTS"
    }

    public function down()
    {
        $this->forge->dropTable('seguidores', true);
    }
}
