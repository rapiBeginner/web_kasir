<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelanggan' => [
                'type'=>'INT',
                'constraint'=>11,
                'auto_increment'=>true,
                'unsigned'=>true
            ],
            'nama_pelanggan' => [
                'type'=>'VARCHAR',
                'constraint'=>255,
            ],
            'alamat' => [
                'type'=>'VARCHAR',
                'constraint'=>255,
            ],
            'no_telp' => [
                'type'=>'INT',
                'constraint'=>20,
            ],
            'created_at'=>[
                'type'=>'DATETIME'
            ],
            'updated_at'=>[
                'type'=>'DATETIME'
            ],
            'deleted_at'=>[
                'type'=>'DATETIME'
            ],
        ]);
        $this->forge->addPrimaryKey('id_pelanggan');
        $this->forge->createTable('tb_pelanggan');
    }

    public function down()
    {
        //
    }
}
