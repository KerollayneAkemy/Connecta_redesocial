<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLikes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'postagem_id' => [
                'type' => 'INT'
            ],
            'usuario_id' => [
                'type' => 'INT'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('likes');
    }

    public function down()
    {
        $this->forge->dropTable('likes');
    }
}