<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaqWis;
use App\Http\Resources\WisataSrc;
use Illuminate\Support\Facades\Validator;

class faqwisCon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = FaqWis::where('wisata_id',$id)->get();
        return new WisataSrc(true,'Faq dari wisata '.$id,$data);
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
    public function store(Request $r,$id)
    {
        $val = Validator::make( $r->all(), [
            'tanya' => 'required',
            'jawab' => 'required'
        ],
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        if($val->fails()){
            return new WisataSrc(false,"error",$val->errors());
        }

        $data = FaqWis::create([
            'wisata_id' => $id,
            'quest' => $r->tanya,
            'ans' => $r->jawab
        ]);

        return new WisataSrc(true, 'Data berhasil ditambahkan', $data);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$faq)
    {
        $data = FaqWis::where([
            'wisata_id' => $id,
            'id' => $faq
        ])->first();

        $data->delete();
        return new WisataSrc(true,'faq berhasil dihapus',$data);
    }
}
