<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImgWisata;
use App\Http\Resources\WisataSrc;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class imgWisataCon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = ImgWisata::where('wisata_id',$id)->get();
        return new WisataSrc(true, 'Seluruh gambar dari wisata '.$id,$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r, $id)
    {
        $val = Validator::make($r->all(),[
            'foto' => 'required|mimes:jpg,png,jpeg',
        ],
        $message = [
            'required' => ':attribute harus diisi',
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        if($val->fails()){
            return new WisataSrc(false,"error",$val->errors());
        }

        $file = $r->file('foto');
        $filename = time().'.'.$file->extension();
        
        $path = $file->storeAs('public/wisata',$filename);
        $wisata = ImgWisata::create([
            'wisata_id' => $id,
            'foto' => "/storage/wisata/$filename"
        ]);
        return new WisataSrc(true,"Gambar berhasil ditambahkan!",$wisata);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $r, $id, $foto)
    {
        $data = ImgWisata::where([
            'wisata_id' => $id,
            'id' => $foto
        ])->first();

        $val = Validator::make($r->all(),[
            'foto' => 'required|mimes:jpg,png,jpeg',
        ],
        $message = [
            'required' => ':attribute harus diisi',
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        
        if($val->fails()){
            return new WisataSrc(false,"error",$val->errors());
        }
        
        $fotodir = explode('/',$data['foto']);
        $foto = end($fotodir);
        $fotoname = explode('.',$foto);

        $file = $r->file('foto');
        $filex = $file->extension();
        $newname = $fotoname[0].'.'.$filex;
        // dd($newname);
        
        Storage::delete('public/wisata/'.$foto);
        $path = $file->storeAs('public/wisata',$newname);
        $databaru = [
            'foto' => "/storage/wisata/$newname"
        ];
        $wisata = $data->update($databaru);
        return new WisataSrc(true,"Gambar berhasil diubah!",$databaru);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$foto)
    {
        $data = ImgWisata::where([
            'wisata_id' => $id,
            'id' => $foto
        ])->first();
        $fotodir = explode('/',$data['foto']);
        $foto = end($fotodir);
        
        Storage::delete('public/wisata/'.$foto);
        $data->delete();
        return new WisataSrc(true,"Hapus data berhasil",['success']);
    }
}
