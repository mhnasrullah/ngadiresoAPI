<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\BeritaSrc;
use App\Models\Berita;

class beritaCon extends Controller
{
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
        $file = $r->file('foto');
        $filename = $r->slug.'.'.$file->extension();
        $file->storeAs('public/berita',$filename);
        
        $show = Berita::where('slug', $r->slug)->first();

        if(!$show){
            $url = Storage::url($filename);
            $berita = Berita::create([
                'slug' => $r->slug,
                'judul' => $r->judul,
                'text' => $r->text,
                'foto' => $url
            ]);
            return new BeritaSrc(true,"Berita berhasil ditambahkan!",$berita);
        }else{
            return new BeritaSrc(false,"Ganti Slug dong!",['error']);
        }

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
