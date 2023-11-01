<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Comment extends Migration
{
	public function up()
    {
		$this->db->disableForeignKeyChecks();

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'text' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
		$this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->createTable('comments');       
		

		$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('comments');
    }
}
