<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edit;
use App\Http\Resources\BeritaSrc;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class editableCon extends Controller
{
    public function getAll(){
        $data = Edit::first();
        return new BeritaSrc(true,'semua data yang bisa di edit',$data);
    }
    
    public function create(Request $r){
        
        $isIsset = Edit::first();
        if($isIsset != null) {
            return new BeritaSrc(false,'Data sudah tersedia',['error']);
        }

        $jumbotron = $r->jumbotron;
        $jumbotronName = 'jumbotron.'.$jumbotron->extension();
        $jumbotron->storeAs('public/edit',$jumbotronName);

        $imgTentangDesa = $r->imgTentangDesa;
        $imgTentangDesaName = 'imgTentangDesa.'.$imgTentangDesa->extension();
        $imgTentangDesa->storeAs('public/edit',$imgTentangDesaName);
        
        $imgKades = $r->imgKades;
        $imgKadesName = 'imgKades.'.$imgKades->extension();
        $imgKades->storeAs('public/edit',$imgKadesName);
        
        $jmbtSejarah = $r->jmbtSejarah;
        $jmbtSejarahName = 'jmbtSejarah.'.$jmbtSejarah->extension();
        $jmbtSejarah->storeAs('public/edit',$jmbtSejarahName);
        
        $jmbtKabar = $r->jmbtKabar;
        $jmbtKabarName = 'jmbtKabar.'.$jmbtKabar->extension();
        $jmbtKabar->storeAs('public/edit',$jmbtKabarName);
        
        $jmbtFaq = $r->jmbtFaq;
        $jmbtFaqName = 'jmbtFaq.'.$jmbtFaq->extension();
        $jmbtFaq->storeAs('public/edit',$jmbtFaqName);
        
        $jmbtWisata = $r->jmbtWisata;
        $jmbtWisataName = 'jmbtWisata.'.$jmbtWisata->extension();
        $jmbtWisata->storeAs('public/edit',$jmbtWisataName);
        
        $jmbtSurat = $r->jmbtSurat;
        $jmbtSuratName = 'jmbtSurat.'.$jmbtSurat->extension();
        $jmbtSurat->storeAs('public/edit',$jmbtSuratName);

        $data = [
            'jumbotron' => '/storage/edit/'.$jumbotronName,
            'tentangDesa' => $r->tentangDesa,
            'imgTentangDesa' => '/storage/edit/'.$imgTentangDesaName,
            'imgKades' => '/storage/edit/'.$imgKadesName,
            'sambutanKades' => $r->sambutanKades,
            'namaKades' => $r->namaKades,
            'jmlPria' => $r->jmlPria,
            'jmlWanita' => $r->jmlWanita,
            'jmlPenduduk' => $r->jmlPenduduk,
            'jmbtSejarah' => '/storage/edit/'.$jmbtSejarahName,
            'jmbtKabar' => '/storage/edit/'.$jmbtKabarName,
            'jmbtFaq' => '/storage/edit/'.$jmbtFaqName,
            'jmbtWisata' => '/storage/edit/'.$jmbtWisataName,
            'jmbtSurat' => '/storage/edit/'.$jmbtSuratName,
        ];
        
        $scs = Edit::create($data);
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di dibuat']);
    }
    
    public function updTentangDesa(Request $r){
        $data = Edit::first();
        $data->tentangDesa = $r->text;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

    public function updSamKades(Request $r){
        $data = Edit::first();
        $data->sambutanKades = $r->text;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

    public function updNamaKades(Request $r){
        $data = Edit::first();
        $data->namaKades = $r->text;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

    public function jmlPria(Request $r){
        $data = Edit::first();
        $data->jmlPria = $r->text;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

    public function jmlWanita(Request $r){
        $data = Edit::first();
        $data->jmlWanita = $r->text;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

    public function jmlPenduduk(Request $r){
        $data = Edit::first();
        $data->jmlPenduduk = $r->text;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }
    
    public function updJumbotron(Request $r){
        $data = Edit::first();

        $fotodir = explode('/',$data['jumbotron']);
        $foto = end($fotodir);

        $val = Validator::make($r->all(),[
            'foto' => 'required|mimes:jpg,png,jpeg',
        ],
        $message = [
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        if($val->fails()){
            return new BeritaSrc(false,"error",$val->errors());
        }

        Storage::delete('public/edit/'.$foto);

        $jumbotron = $r->foto;
        $jumbotronName = 'jumbotron.'.$jumbotron->extension();
        $jumbotron->storeAs('public/edit',$jumbotronName);

        $data->jumbotron = '/storage/edit/'.$jumbotronName;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

    public function updImgTentangDesa(Request $r){
        $data = Edit::first();

        $fotodir = explode('/',$data['imgTentangDesa']);
        $foto = end($fotodir);

        $val = Validator::make($r->all(),[
            'foto' => 'required|mimes:jpg,png,jpeg',
        ],
        $message = [
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        if($val->fails()){
            return new BeritaSrc(false,"error",$val->errors());
        }

        Storage::delete('public/edit/'.$foto);

        $imgTentangDesa = $r->foto;
        $imgTentangDesaName = 'imgTentangDesa.'.$imgTentangDesa->extension();
        $imgTentangDesa->storeAs('public/edit',$imgTentangDesaName);

        $data->imgTentangDesa = '/storage/edit/'.$imgTentangDesaName;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

    public function updImgKades(Request $r){
        $data = Edit::first();

        $fotodir = explode('/',$data['imgKades']);
        $foto = end($fotodir);

        $val = Validator::make($r->all(),[
            'foto' => 'required|mimes:jpg,png,jpeg',
        ],
        $message = [
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        if($val->fails()){
            return new BeritaSrc(false,"error",$val->errors());
        }

        Storage::delete('public/edit/'.$foto);

        $imgKades = $r->foto;
        $imgKadesName = 'imgKades.'.$imgKades->extension();
        $imgKades->storeAs('public/edit',$imgKadesName);

        $data->imgKades = '/storage/edit/'.$imgKadesName;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

    public function updJmbtSejarah(Request $r){
        $data = Edit::first();

        $fotodir = explode('/',$data['jmbtSejarah']);
        $foto = end($fotodir);

        $val = Validator::make($r->all(),[
            'foto' => 'required|mimes:jpg,png,jpeg',
        ],
        $message = [
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        if($val->fails()){
            return new BeritaSrc(false,"error",$val->errors());
        }

        Storage::delete('public/edit/'.$foto);

        $jmbtSejarah = $r->foto;
        $jmbtSejarahName = 'jmbtSejarah.'.$jmbtSejarah->extension();
        $jmbtSejarah->storeAs('public/edit',$jmbtSejarahName);

        $data->jmbtSejarah = '/storage/edit/'.$jmbtSejarahName;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

    public function updJmbtKabar(Request $r){
        $data = Edit::first();

        $fotodir = explode('/',$data['jmbtKabar']);
        $foto = end($fotodir);

        $val = Validator::make($r->all(),[
            'foto' => 'required|mimes:jpg,png,jpeg',
        ],
        $message = [
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        if($val->fails()){
            return new BeritaSrc(false,"error",$val->errors());
        }

        Storage::delete('public/edit/'.$foto);

        $jmbtKabar = $r->foto;
        $jmbtKabarName = 'jmbtKabar.'.$jmbtKabar->extension();
        $jmbtKabar->storeAs('public/edit',$jmbtKabarName);

        $data->jmbtKabar = '/storage/edit/'.$jmbtKabarName;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

    public function updJmbtFaq(Request $r){
        $data = Edit::first();

        $fotodir = explode('/',$data['jmbtFaq']);
        $foto = end($fotodir);

        $val = Validator::make($r->all(),[
            'foto' => 'required|mimes:jpg,png,jpeg',
        ],
        $message = [
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        if($val->fails()){
            return new BeritaSrc(false,"error",$val->errors());
        }

        Storage::delete('public/edit/'.$foto);

        $jmbtFaq = $r->foto;
        $jmbtFaqName = 'jmbtFaq.'.$jmbtFaq->extension();
        $jmbtFaq->storeAs('public/edit',$jmbtFaqName);

        $data->jmbtFaq = '/storage/edit/'.$jmbtFaqName;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

    public function updJmbtWisata(Request $r){
        $data = Edit::first();

        $fotodir = explode('/',$data['jmbtWisata']);
        $foto = end($fotodir);

        $val = Validator::make($r->all(),[
            'foto' => 'required|mimes:jpg,png,jpeg',
        ],
        $message = [
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        if($val->fails()){
            return new BeritaSrc(false,"error",$val->errors());
        }

        Storage::delete('public/edit/'.$foto);

        $jmbtWisata = $r->foto;
        $jmbtWisataName = 'jmbtWisata.'.$jmbtWisata->extension();
        $jmbtWisata->storeAs('public/edit',$jmbtWisataName);

        $data->jmbtWisata = '/storage/edit/'.$jmbtWisataName;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

    public function updJmbtSurat(Request $r){
        $data = Edit::first();

        $fotodir = explode('/',$data['jmbtSurat']);
        $foto = end($fotodir);

        $val = Validator::make($r->all(),[
            'foto' => 'required|mimes:jpg,png,jpeg',
        ],
        $message = [
            'mimes' => 'format :attribute harus berupa jpg,png,jpeg',
        ]);

        if($val->fails()){
            return new BeritaSrc(false,"error",$val->errors());
        }

        Storage::delete('public/edit/'.$foto);

        $jmbtSurat = $r->foto;
        $jmbtSuratName = 'jmbtSurat.'.$jmbtSurat->extension();
        $jmbtSurat->storeAs('public/edit',$jmbtSuratName);

        $data->jmbtSurat = '/storage/edit/'.$jmbtSuratName;
        $data->save();
        return new BeritaSrc(true,'berhasil diupdate',['data berhasil di update']);
    }

}
