<?php

namespace App\Http\Controllers;

use App\Akomodasi;
use DB;
use Illuminate\Http\Request;

class KontrakanController extends Controller
{
    public function index()
    {
        $lists = DB::table('akomodasis')->where('jenis_akomodasi', 'kontrakan')->where('status_akomodasi', 'ver')->paginate(6);
        return view('kontrakan.kontrakan', ['lists' => $lists]);
    }

    public function byKecamatan($kecamatan)
    {
        $lists = DB::table('akomodasis')->where('kecamatan', $kecamatan)->where('jenis_akomodasi', 'kontrakan')->where('status_akomodasi', 'ver')->paginate(6);
        return view('kontrakan.kontrakan', ['lists' => $lists]);
    }

    public function detail($id)
    {
        $detail = Akomodasi::where('id_akomodasi', $id)->first();
        $detail_penyedia = Akomodasi::where('akomodasis.id_akomodasi', $id)
        ->rightjoin('akomodasi_users', 'akomodasis.id_akomodasi', '=', 'akomodasi_users.id_akomodasi')
        ->rightjoin('users', 'akomodasi_users.id_user', '=', 'users.id')
        ->where('akomodasis.jenis_akomodasi', 'kontrakan')
        ->first();
        return view('kontrakan.detail', compact('detail', 'detail_penyedia'));
    }
}
