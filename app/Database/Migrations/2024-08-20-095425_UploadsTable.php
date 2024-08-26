<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UploadsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'eventname'    => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'filename'    => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'user_id'     => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'created_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('uploads');
    }

    public function down()
    {
        $this->forge->dropTable('uploads');
    }
}
