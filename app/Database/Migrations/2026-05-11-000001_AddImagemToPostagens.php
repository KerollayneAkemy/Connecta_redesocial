<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImagemToPostagens extends Migration
{
    public function up()
    {
        $fields = [
            'imagem' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'texto'
            ]
        ];
        $this->forge->addColumn('postagens', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('postagens', 'imagem');
    }
}
