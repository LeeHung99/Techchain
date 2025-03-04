<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;


Paginator::useBootstrap();

class SanPhamController extends Controller
{
    public function __construct()
    {
        $loaisp = DB::table('loai')
            ->where('anhien', 1)
            ->orderBy('thutu')
            ->get();
        View::share('loaisp', $loaisp);
    }
    function index()
    {
        $spnoibat = DB::table('sanpham')
            ->where('hot', 1)
            ->where('anhien', 1)
            ->orderBy('ngay', 'desc')
            ->limit(8)
            ->get();
        $spxemnhieu = DB::table('sanpham')
            ->where('anhien', 1)
            ->orderBy('soluotxem', 'desc')
            ->limit(8)
            ->get();

        return view('home', ['spnoibat' => $spnoibat, 'spxemnhieu' => $spxemnhieu]);
    }
    function chitiet($id = 0)
    {
        $sp = DB::table('sanpham')->where('id_sp', $id)->first();
        // $idsp = $sp->id_sp;
        $tc = $sp->tinhchat;
        $idloai = $sp->id_loai;
        $splienquan = DB::table('sanpham')
            ->where('id_loai', $idloai)
            ->where('tinhchat', $tc)
            ->orderBy('ngay', 'desc')
            ->limit(4)
            ->get()
            ->except($id); // loại trừ sản phẩm
        return view('spchitiet', ['id' => $id, 'title' => $sp->ten_sp, 'sp' => $sp, 'splienquan' => $splienquan]);

        // return view('spchitiet', ['id' => $id]);
    }
    function sptrongloai($idloai = 0)
    {
        $perpage = 12;
        $listsp = DB::table('sanpham')
            ->where('id_loai', $idloai)
            ->paginate($perpage);
        $tenloai = DB::table('loai')->where('id_loai', $idloai)->value('ten_loai');
        return view('sptrongloai', ['id' => $idloai, 'title' => $tenloai, 'listsp' => $listsp]);
    }
    function themvaogio(Request $request, $id_sp = 0, $soluong = 1)
    {
        if ($request->session()->exists('cart') == false) { //chưa có cart trong session           
            Session::push('cart', ['id_sp' => $id_sp,  'soluong' => $soluong]);
        } else { // đã có cart, kiểm tra id_sp có trong cart không
            $cart =  $request->session()->get('cart');
            $index = array_search($id_sp, array_column($cart, 'id_sp'));
            if ($index != '') { //id_sp có trong giỏ hàng thì tăhg số lượng
                $cart[$index]['soluong'] += $soluong;
                $request->session()->put('cart', $cart);
            } else { //sp chưa có trong arrary cart thì thêm vào 
                $cart[] = ['id_sp' => $id_sp, 'soluong' => $soluong];
                $request->session()->put('cart', $cart);
            }
        }
        // $request->session()->forget('cart');
        return redirect('/');
    }
    function hiengiohang(Request $request)
    {
        $cart =  $request->session()->get('cart');
        return view('hiengiohang', ['cart' => $cart]);
    }
    function xoasptronggio(Request $request, $id_sp = 0)
    {
        $cart =  $request->session()->get('cart');
        $index = array_search($id_sp, array_column($cart, 'id_sp'));
        if ($index != '') {
            array_splice($cart, $index, 1);
            $request->session()->put('cart', $cart);
        }
        return redirect('/hiengiohang');
    }
    function xoagiohang(Request $request)
    {
        $request->session()->forget('cart');
        return redirect('/');
    }
    function thanhtoan()
    {
        return view('thanhtoan');
    }
    function luudonhang(Request $request)
    {
        if ($request->session()->exists('cart') == false) { //chưa có cart trong session    
            session::flash('thongbao', 'Chưa có sản phẩm nào trong giỏ hàng');
            return redirect("/thongbao");
        }
        $ho_ten = $request->post('ho_ten');
        $dia_chi = $request->post('dia_chi');
        $dien_thoai = $request->post('dien_thoai');
        $email = $request->post('email');
        $id_dh = DB::table('donhang')->insertGetId([
            'ho_ten' => $ho_ten, 'dia_chi' => $dia_chi, 'dien_thoai' => $dien_thoai, 'email' => $email
        ]);

        $cart =  $request->session()->get('cart');
        foreach ($cart as $c) {
            $id_sp = $c['id_sp'];
            $soluong = $c['soluong'];
            $gia = DB::table('sanpham')->where('id_sp', '=', $id_sp)->value('gia');
            DB::table('donhangchitiet')->insert([
                'id_dh' => $id_dh, 'id_sp' => $id_sp, 'so_luong' => $soluong, 'gia' => $gia
            ]);
        }
        $request->session()->forget('cart');
        session::flash('thongbao', 'Cảm ơn bạn! Đơn hàng đã ghi nhận');
        return redirect('/thongbao');
    }
    function thongbao(){
        return view("thongbao");
    }
    function download(){ return view("download"); }
}
