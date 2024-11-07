<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "produk_id"=>[
                'type'=>'INT',
                'constraint'=>11,
                'auto_increment'=>true,
            ],
            'nama_produk'=>[
                'type'=>'VARCHAR',
                'constraint'=>255
            ],
            'harga'=>[
                'type'=>'DECIMAL',
                'constraint'=>'10,2',
            ],
            'stok'=>[
                'type'=>'INT',
                'constraint'=>11,
            ],
        ]);
        $this->forge->addPrimaryKey('produk_id');
        $this->forge->createTable('tb_product');
    }

    public function down()
    {
        $this->forge->dropTable('tb_product');
    }
}
