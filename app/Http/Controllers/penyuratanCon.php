<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyuratan;
use App\Http\Resources\WisataSrc;
use Illuminate\Support\Facades\Validator;


class penyuratanCon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penyuratan::all();
        return new WisataSrc(true,'semua data penyuratan',$data);   
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
    public function store(Request $r)
    {
        $val = Validator::make($r->all(),[
            'nama' => 'required',
            'link' => 'required',
        ],
        $message = [
            'required' => ':attribute harus diisi',
        ]);

        if($val->fails()){
            return new WisataSrc(false,"error",$val->errors());
        }

        $data = Penyuratan::create([
            'nama' => $r->nama,
            'link' => $r->link,
        ]);

        return new WisataSrc(true, 'data berhasil ditambahkan', $data);
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
    public function update(Request $r, $id)
    {
        $val = Validator::make($r->all(),[
            'nama' => 'required',
            'link' => 'required',
        ],
        $message = [
            'required' => ':attribute harus diisi',
        ]);

        if($val->fails()){
            return new WisataSrc(false,"error",$val->errors());
        }

        $data = Penyuratan::where('id',$id)->first();
        $data->update([
            'nama' => $r->nama,
            'link' => $r->link,
        ]);

        return new WisataSrc(true, 'data berhasil diubah', $data);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Penyuratan::find($id);
        $data->delete();
        return new WisataSrc(true, 'data berhasil dihapus', ['success']);
    }
}
