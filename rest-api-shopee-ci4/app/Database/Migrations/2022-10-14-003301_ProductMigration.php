<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT'
            ],
            'product_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'product_stock' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'product_price' => [
                'type' => 'INT',
                'constraint' => 5
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'user', 'id');
        $this->forge->createTable('product');
    }

    public function down()
    {
        $this->forge->dropTable('product');
    }
}
