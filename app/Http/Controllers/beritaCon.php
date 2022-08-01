<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BeritaSrc;
use App\Models\Berita;
use Carbon\Carbon;

class beritaCon extends Controller
{

    public function showImage($id){
        $data = Berita::find($id);
        // dd($data['foto']);
        return view('tes',$data);
        // return redirect()->to('storage/'.$data['foto']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = Berita::all();
        return new BeritaSrc(true,"Semua Berita",$berita);
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
            'slug' => 'required|unique:beritas',
            'judul' => 'required',
            'text' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg',
        ],
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        if($val->fails()){
            return new BeritaSrc(false,"erroe",$val->errors());
        }

        $file = $r->file('foto');
        $filename = time().'.'.$file->extension();
        
        $path = $file->storeAs('public/berita',$filename);
        $berita = Berita::create([
            'slug' => $r->slug,
            'judul' => $r->judul,
            'text' => $r->text,
            'foto' => "/storage/berita/$filename"
        ]);
        return new BeritaSrc(true,"Berita berhasil ditambahkan!",$berita);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $berita = Berita::find($id);
        return new BeritaSrc(true,"Semua Berita",$berita);
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

        $rules = [
            'judul' => 'required',
            'text' => 'required',
            'foto' => 'mimes:jpg,png,jpeg',
        ];
        
        $last = Berita::where('id', $id)->first();
        if($r->slug != $last->slug){
            $rules['slug'] = 'required|unique:beritas';
        }else{
            $rules['slug'] = 'required';
        }

        $val = Validator::make( $r->all(), $rules,
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        if($val->fails()){
            return new BeritaSrc(false,"error",$val->errors());
        }
        
        $fotodir = explode('/',$last['foto']);
        $foto = end($fotodir);
        $fotoname = explode('.',$foto);

        $data = [
            'slug' => $r->slug,
            'judul' => $r->judul,
            'text' => $r->text
        ];

        // dd($newname);
        
        $file = $r->file('foto');
        dd($file);
        if($file != null){
            $filex = $file->extension();
            $newname = $fotoname[0].'.'.$filex;

            Storage::delete('public/berita/'.$foto);
            $file->storeAs('public/berita/',$newname);
            
            $data['foto'] = "/storage/berita/$newname";
        }

        $last->update($data);

        return new BeritaSrc(true,"Berita berhasil diubah!",$data);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Berita::find($id);
        $fotodir = explode('/',$data['foto']);
        $foto = end($fotodir);
        
        Storage::delete('public/berita/'.$foto);
        $data->delete();
        return new BeritaSrc(true,"Hapus data berhasil",['success']);
    }
}
