<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pangkat;
use App\Models\NaikPangkat;
use Illuminate\Http\Request;
use Alert;
use App\Models\NaikPangkatFT;
use App\Models\NaikPangkatPS;
use App\Models\NaikPangkatPSI;
use PhpParser\Node\Stmt\Return_;

class NaikPangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    //--ADMIN--
    //Menu Kenaikan Pangkat
    public function naikPangkatMenuAdmin()
    {
        return view('pegawai.admin.kenaikan.naik-pangkat.menu');
    }

    //Halaman Data Kenaikan Pangkat PNS Jabtan Reguler Eselon Struktural
    public function AdminStruktural()
    {
        $naikPangkat = NaikPangkat::all();
        return view('pegawai.admin.kenaikan.naik-pangkat.eselon-struktural.index', compact('naikPangkat'));
    }

    //Halaman Data Kenaikan Pangkat PNS Jabtan Pelaksana/Staf
    public function AdminPS()
    {

        $naikPangkat = NaikPangkatPS::all();
        return view('pegawai.admin.kenaikan.naik-pangkat.pelaksana_staf.index', compact('naikPangkat'));

    }

    //Halaman Data Kenaikan Pangkat PNS Jabtan Pelaksana/Staf Penyesuaian Ijazah
    public function AdminPSI()
    {

        $naikPangkat = NaikPangkatPS::all();
        return view('pegawai.admin.kenaikan.naik-pangkat.pelaksana_staf_ijazah.index',compact('naikPangkat'));

    }

    //Halaman Data Kenaikan Pangkat PNS Jabtan Fungsional Tertentu
    public function AdminFT()
    {

        $naikPangkat = naikPangkatFt::all();
        return view('pegawai.admin.kenaikan.naik-pangkat.fungsional_tertentu.index', compact('naikPangkat'));

    }



    //--PEGAWAI--
    //Menu Kenaikan Pangkat
    public function naikPangkatMenu()
    {
        return view('pegawai.pns.kenaikan.naik_pangkat.menu');
    }


    // ---Jabatan Reguler Eselon Struktural----
    //Halaman Riwayat
    public function pangkatStrutural()
    {
        $user = auth()->id();
        $naikPangkat = NaikPangkat::where('user_id', $user)->get();
        return view('pegawai.pns.kenaikan.naik_pangkat.eselon_struktural.riwayat',compact('naikPangkat'));
    }

    //Halaman Tambah Data Kenaikan Pangkat Jabatan Reguler Eselon Struktural
    public function tambahStruktural()
    {
        $pangkat = Pangkat::get();
        return view('pegawai.pns.kenaikan.naik_pangkat.eselon_struktural.create', [
            'user' => User::where('users.id','=',auth()->user()->id)->join('kepegawaians','kepegawaians.user_id','=','users.id')
            ->first(),
            'pangkat' => $pangkat,
        ]);
    }

    //Fungsi Simpan Data Kenaikan Pangkat Jabatan Reguler Eselon Struktural
    public function storeStruktrural(Request $request)
    {
        $validateData = $request->validate([
            'pangkat_id' => 'required',
            'mulai_tanggal' => 'required',
            'naik_selanjutnya' => 'required',
            'tgl_usulan' => 'required',
            'link' => 'required',
        ]);

        $validateData['user_id'] = auth()->user()->id;
        NaikPangkat::create($validateData);
        Alert::success('Sukses', 'Data Usul Kenaikan Pangkat Jabatan Eselon Struktural Berhasil Disimpan');
        return redirect()->route('menu.pangkat.struktural');
    }

    //Halaman Edit (Belum Ada)
    //Fungsi Update (Belum Ada)
    //Halaman Detail (Belum Ada


    // ---Jabatan Pelaksana/Staf----
    //Halaman Riwayat
    public function pangkatPelaksanaStaf()
    {
        $user = auth()->id();
        $naikPangkat = NaikPangkatPS::where('user_id', $user)->get();
        return view('pegawai.pns.kenaikan.naik_pangkat.pelaksana_staf.riwayat',compact('naikPangkat'));
    }

    //Halaman Tambah Data Kenaikan Pangkat Jabatan Pelaksana/Staf
    public function tambahPelaksanaStaf()
    {
        $pangkat = Pangkat::get();
        return view('pegawai.pns.kenaikan.naik_pangkat.pelaksana_staf.create', [
            'user' => User::where('users.id','=',auth()->user()->id)->join('kepegawaians','kepegawaians.user_id','=','users.id')
            ->first(),
            'pangkat' => $pangkat,
        ]);
    }

    //Fungsi Simpan (Belum Ada)
    //Halaman Edit (Belum Ada)
    //Fungsi Update (Belum Ada)
    //Halaman Detail (Belum Ada



    // ---Jabatan Reguler Jabatan Pelaksana/Staf Penyesuaian Ijazah----
    //Halaman Riwayat Kenaikan Pangkat Jabatan Pelaksana/Staf Penyesuaian Ijazah
    public function pangkatPeStafijazah()
    {
        $user = auth()->id();
        $naikPangkat = NaikPangkatPSI::where('user_id', $user)->get();
        return view('pegawai.pns.kenaikan.naik_pangkat.pelaksana_staf_ijazah.riwayat',compact('naikPangkat'));
    }

    //Halaman Tambah Data Kenaikan Pangkat Jabatan Pelaksana/Staf Penyesuaian Ijazah
    public function tambahPSI()
    {
        $pangkat = Pangkat::get();
        return view('pegawai.pns.kenaikan.naik_pangkat.pelaksana_staf_ijazah.create', [
            'user' => User::where('users.id','=',auth()->user()->id)->join('kepegawaians','kepegawaians.user_id','=','users.id')
            ->first(),
            'pangkat' => $pangkat,
        ]);
    }

    //Fungsi Simpan (Belum Ada)
    //Halaman Edit (Belum Ada)
    //Fungsi Update (Belum Ada)
    //Halaman Detail (Belum Ada


    // ---Jabatan Reguler Jabatan Fungsional Tertentu----
    //Halaman Riwayat Kenaikan Pangkat Jabatan Funsional Tertentu
    public function naikPangkatFt()
    {
        $user = auth()->id();
        $naikPangkat = NaikPangkatFT::where('user_id', $user)->get();
        return view('pegawai.pns.kenaikan.naik_pangkat.fungsional_tertentu.riwayat',compact('naikPangkat'));
    }

    //Halaman Tambah Data Kenaikan Pangkat Jabatan Fungsional tertentu
    public function tambahFt()
    {
        $pangkat = Pangkat::get();
        return view('pegawai.pns.kenaikan.naik_pangkat.fungsional_tertentu.create', [
            'user' => User::where('users.id','=',auth()->user()->id)->join('kepegawaians','kepegawaians.user_id','=','users.id')
            ->first(),
            'pangkat' => $pangkat,
        ]);
    }

    //Fungsi Simpan (Belum Ada)
    //Halaman Edit (Belum Ada)
    //Fungsi Update (Belum Ada)
    //Halaman Detail (Belum Ada

}
