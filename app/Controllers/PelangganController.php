<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel;
use CodeIgniter\HTTP\ResponseInterface;

class PelangganController extends BaseController
{
    protected $pelanggan;
    public function __construct()
    {
        $this->pelanggan=new PelangganModel();
    }
    public function index(){
        return view('v_pelanggan');
    }

    public function tampil()
    {
        $data=$this->pelanggan->findAll();
        return response()->setJSON($data);
    }

    public function simpan(){
        $data=$this->request->getVar();
        $this->pelanggan->save($data);
        return response()->setJSON([
            "status"=>"success",
            "message"=>"Data berhasil ditambahkan"
        ]);
    }

    public function edit(){
        $data=$this->request->getVar();
        $this->pelanggan->update($data["id_pelanggan"], $data);
        return response()->setJSON([
            "status"=>"success",
            "message"=>"Data berhasil diedit"
        ]);
    }

    public function hapus(){
        $id=$this->request->getVar("id_pelanggan");
        $this->pelanggan->delete($id);
        return response()->setJSON([
            "status"=>"success",
            "message"=>"Data berhasil dihapus"
        ]);
    }
}
