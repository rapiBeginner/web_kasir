<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProdukController extends BaseController
{
    protected $produk;
    public function __construct()
    {
        $this->produk = new ProdukModel();
    }
    public function index()
    {
        return view('v_produk');
    }

    public function tampil(){
        $prdk= $this->produk->findAll();

        return $this->response->setJSON([
            'status'=>'success',
            'produk'=>$prdk
        ]);
    }

    public function simpan(){
        $validation= \Config\Services::validation();
        $validation->setRules([
            'nama_produk'=>'required',
            'harga'=>'required|decimal',
            'stok'=>'required|integer',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status'=>'error',
                'errors'=>$validation->getErrors(),
            ]);
        }
        $gambar= $this->request->getFile('gambar');
        $gambarName= $gambar->getRandomName();
        $gambar->move(ROOTPATH . 'public/uploads', $gambarName); 

        $data=[
            'gambar'=>$gambarName,
            'nama_produk'=>$this->request->getVar('nama_produk'),
            'harga'=>$this->request->getVar('harga'),
            'stok'=>$this->request->getVar('stok'),
        ];

        $this->produk->save($data);

        return $this->response->setJSON([
            'status'=>'success',
            'message'=>'Data produk berhasil di simpan',
            'gambar'=>$gambar
        ]);
    }

    public function hapus(){
        $id= $this->request->getVar('id');
        $data=$this->produk->find($id);
        unlink(ROOTPATH."public/uploads/{$data['gambar']}");
        $this->produk->delete($id);
        return response()->setJSON([
            'message'=>'Data sudah dihapus'
        ]);
    }

    public function edit(){
        $request= $this->request->getVar();
        $data=[
            "nama_produk"=>$request["nama_produk"],
            "harga"=>$request["harga"],
            "stok"=>$request["stok"],
        ];
        $Produk= $this->produk->find($request['produk_id']);

        if($gambar= $this->request->getFile('gambar')){
            unlink(ROOTPATH. "public/uploads/{$Produk['gambar']}");//Hapus gambar lama dari folder
            $namaGambar= $gambar->getRandomName();
            $gambar->move(ROOTPATH.'public/uploads', $namaGambar);
            $data["gambar"]=$namaGambar;
        }

        $this->produk->update($request['produk_id'],$data);
        return response()->setJSON(
            [
                "message"=>"Data telah diperbarui"
            ]
        );
    }

}
