<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Konten;
use App\Pesan;

class CartController extends Controller
{
    public function getCart($kdbook){
        return Cart::where('kd_book', $kdbook)->get();
    }

    public function getCartKontenByUserKdBook($kdbook, $userid, $limit){
        $clause =[['kd_book', $kdbook], ['user_id', $userid], ['status', 'P']];
        $pesan = Pesan::select('kd_book')->where($clause);
        $cart = Cart::select('konten_id')->whereIn('kd_book', $pesan);
        return Konten::whereIn('id', $cart)->paginate($limit);
    }

    public function getTotal($kdbook, $userid){
        $clause = [['kd_book', $kdbook], ['user_id', $userid], ['status', 'P']];
        $pesan = Pesan::select('kd_book')->where($clause);
        $cart = Cart::wherein('kd_book', $pesan)->sum('total');
        $cartjum = Cart::wherein('kd_book', $pesan)->sum('jumlah');
        // $konten = Konten::whereIn('id', $cart)->sum('harga');
        $sum = (int)$cart+20;
        return response()->json([
            "subtotal" => $cart,
            "tax"=> 2000,
            "total" => $sum,
            "jumlah" => $cartjum
        ], 200);
    }

    public function cekCart($kdbook, $userid, $kontenid){
        $clausePesan = [['kd_book', $kdbook], ['user_id', $userid], ['status', 'P']];
        $pesan = Pesan::select('kd_book')->where($clausePesan);
        $clause = [['user_id', $userid], ['konten_id', $kontenid]];
        $cart =  Cart::whereIn('kd_book', $pesan)->where($clause)->first();
        if(!$cart)
            return response()->json([
                "cart" => "sukses",
                "status"=> false
            ], 200);
        else 
            return response()->json([
                "cart" => "sukses",
                "status"=> true
            ], 200);
    }

    public function tambah($kdbook, $userid, $kontenid, $jumlah, $total){
        $cart = new Cart;
        $cart->kd_book = $kdbook;
        $cart->konten_id = $kontenid;
        $cart->user_id = $userid;
        $cart->jumlah = $jumlah;
        $cart->total = $total;
        $cart->save();
        
        return $cart;
    }

    public function hapus($kdbook, $userid, $kontenid){
        $clausePesan = [['kd_book', $kdbook], ['user_id', $userid], ['status', 'P']];
        $pesan = Pesan::select('kd_book')->where($clausePesan);
        $clause = [['user_id', $userid], ['konten_id', $kontenid]];
        $cart =  Cart::whereIn('kd_book', $pesan)->where($clause)->first();
        $cart->delete();

        return $cart;
    }
}
