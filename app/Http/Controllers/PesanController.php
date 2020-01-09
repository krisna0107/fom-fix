<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesan;
use App\PaymentGateWay;
date_default_timezone_set('Asia/Jakarta');

class PesanController extends Controller
{

    public function getPesanByKdBookAndStatus($userid, $stat, $limit){
        $clause = [['user_id', $userid], ['status', $stat]];
        $pesan = Pesan::where($clause)->orderBy('kd_book', 'DESC')->paginate($limit);

        return $pesan;
    }

    /**
     * Generate Kode Book
     * 
     * @return \Illuminate\Http\Response
     */
    public function getKodeBook(){
        $datenow = date('my');
        $getdata = Pesan::where('kd_book', 'like', '%B-'.$datenow.'-%')->orderBy('kd_book', 'desc')->first();
        if($getdata!=null)
            return ++$getdata->kd_book;
        else
            return "B-".$datenow."-00001";
    }

    public function tambah(request $request, $userid, $meja){
        $pesan = new Pesan;
        $pesan->kd_book = $this->getKodeBook();
        $pesan->user_id = $userid;
        $pesan->meja_id = $meja;
        $pesan->status = 'P';
        $pesan->save();

        return $pesan;
    }

    public function setTotal($kdbook, $userid, $total, $bank, $va, $status){
        $clause =[['kd_book', $kdbook], ['user_id', $userid]];
        $pesan = Pesan::where($clause)->first();
        $pesan->total_harga = $total;
        // $pesan->status = 'D';
        $pesan->bank = $bank;
        $pesan->va = $va;
        if($status=="settlement")
            $pesan->status = 'D';
        $pesan->save();

        return $pesan;
    }
}
