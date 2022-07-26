<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\ImgWisata;
use App\Http\Resources\WisataSrc;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class wisataCon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // 'slug',
    // 'nama',
    // 'deskripsi',
    // 'tiket',
    // 'alamat',
    // 'waktu',
    // 'map',
    // 'video'
    public function index()
    {
        $wisata = Wisata::all();
        return new WisataSrc(true,'semua data wisata',$wisata);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $val = Validator::make($r->all(),[
            'slug' => 'required|unique:wisatas',
            'nama' => 'required',
            'deskripsi' => 'required',
            'tiket' => 'required',
            'alamat' => 'required',
            'waktu' => 'required',
            'map' => 'required',
        ],
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
        ]);

        if($val->fails()){
            return new WisataSrc(false,"error",$val->errors());
        }
        
        $wisata = Wisata::create([
            'slug' => $r->slug,
            'nama' => $r->nama,
            'deskripsi' => $r->deskripsi,
            'tiket' => $r->tiket,
            'alamat' => $r->alamat,
            'waktu' => $r->waktu,
            'map' => $r->map,
            'video' => $r->video,
        ]);
        
        return new WisataSrc(true,"Wisata berhasil ditambahkan!",$wisata);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wisata = Wisata::find($id);
        return new WisataSrc(true,"Detail Wisata",$wisata);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $rule = [
            'nama' => 'required',
            'deskripsi' => 'required',
            'tiket' => 'required',
            'alamat' => 'required',
            'waktu' => 'required',
            'map' => 'required',
        ];

        $data = Wisata::find($id);
        if($r->slug != $data['slug']){
            $rule['slug'] = 'required|unique:wisatas';
        }else{
            $rule['slug'] = 'required';
        }

        $val = Validator::make($r->all(),$rule,
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
        ]);

        if($val->fails()){
            return new WisataSrc(false,"error",$val->errors());
        }
        
        $wisata = [
            'slug' => $r->slug,
            'nama' => $r->nama,
            'deskripsi' => $r->deskripsi,
            'tiket' => $r->tiket,
            'alamat' => $r->alamat,
            'waktu' => $r->waktu,
            'map' => $r->map,
            'video' => $r->video,
        ];

        $data->update($wisata);

        return new WisataSrc(true,"Wisata berhasil ditambahkan!",$wisata);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fotoWisata = ImgWisata::where('wisata_id',$id)->get();
        if($fotoWisata){
            foreach($fotoWisata as $f){
                $fotodir = explode('/',$f['foto']);
                $foto = end($fotodir);
                
                Storage::delete('public/wisata/'.$foto);
                $f->delete();
            }
        }

        $wisata = Wisata::find($id);
        $wisata->delete();

        return new WisataSrc(true,"Wisata berhasil dihapus",$wisata);
    }
}
