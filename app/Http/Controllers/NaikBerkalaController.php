<?php

namespace App\Http\Controllers;

use App\Models\FileNaikBerkala;
use App\Models\Gaji;
use App\Models\NaikBerkala;
use App\Models\User;
use Illuminate\Http\Request;
use Alert;

class NaikBerkalaController extends Controller
{

    public function index()
    {
        //
    }

    //--ADMIN--
    //Halaman index Data Kenaikan Gaji Berkala Admin
    public function indexAdmin()
    {
        $naikBerkala = NaikBerkala::all();
        return view('pegawai.admin.kenaikan.naik-gaji-berkala.index',compact('naikBerkala'));
    }

    //Halaman Detail (Belum)
    //Fungsi hapus Belum(Belum)


    //--PEGAWAI--
    //Halaman Riwayat Kenaikan Gaji Berkala PNS
    public function indexPegawai()
    {

        $user = auth()->id();
        $naikBerkala = NaikBerkala::where('user_id', $user)->get();
        return view('pegawai.pns.kenaikan.naik_gaji_berkala.riwayat',compact('naikBerkala'));
    }

    //Halaman Tambah Data kenaikan gaji berkala PNS
    public function createNaikBerkala()
    {
        $gaji = Gaji::get();
        return view('pegawai.pns.kenaikan.naik_gaji_berkala.create', [
            'user' => User::where('users.id','=',auth()->user()->id)->join('kepegawaians','kepegawaians.user_id','=','users.id')
            ->first(),
            'gaji' => $gaji,
        ]);
    }

    //Fungsi Simpan Data Kenaikan gaji berkala pns
    public function simpanData(Request $request)
    {
        $validateData = $request->validate([
            'gaji_id' => 'required',
            'mulai_tanggal' => 'required',
            'naik_selanjutnya' => 'required',
            'tgl_usulan' => 'required',
            'sk_berkala_terakhir' => 'required|mimes:pdf|max:2048',
            'sk_cpns' => 'required|mimes:pdf|max:2048',
            'sk_naik_pangkat_akhir' => 'required|mimes:pdf|max:2048',
            'sk_mangku_jabat' => 'required|mimes:pdf|max:2048',
        ]);

        if($request->file('sk_berkala_terakhir')){
            $fileModel = new FileNaikBerkala();
            $fileName = time().'_'.$request->file('sk_berkala_terakhir')->getClientOriginalName();
            $filePath = $request->file('sk_berkala_terakhir')->storeAs('uploads/skbt', $fileName, 'public');
            $fileModel->file_berkas_path = '/storage/' . $filePath;
            $fileModel->file_berkas=$fileName;
            $fileModel->user_id=$request->idUser;
            $fileModel->save();
            // dd($fileModel->save());
        }

        if($request->file('sk_cpns')){
            $fileModel = new FileNaikBerkala();
            $fileName = time().'_'.$request->file('sk_cpns')->getClientOriginalName();
            $filePath = $request->file('sk_cpns')->storeAs('uploads/sk-cpns', $fileName, 'public');
            $fileModel->file_berkas_path = '/storage/' . $filePath;
            $fileModel->file_berkas=$fileName;
            $fileModel->user_id=$request->idUser;
            $fileModel->save();
        }

        if($request->file('sk_naik_pangkat_akhir')){
            $fileModel = new FileNaikBerkala();
            $fileName = time().'_'.$request->file('sk_naik_pangkat_akhir')->getClientOriginalName();
            $filePath = $request->file('sk_naik_pangkat_akhir')->storeAs('uploads/sk-naik-pangkat-terakhir', $fileName, 'public');
            $fileModel->file_berkas_path = '/storage/' . $filePath;
            $fileModel->file_berkas=$fileName;
            $fileModel->user_id=$request->idUser;
            $fileModel->save();
        }

        if($request->file('sk_mangku_jabat')){
            $fileModel = new FileNaikBerkala();
            $fileName = time().'_'.$request->file('sk_mangku_jabat')->getClientOriginalName();
            $filePath = $request->file('sk_mangku_jabat')->storeAs('uploads/sk-pemangku-jabatan', $fileName, 'public');
            $fileModel->file_berkas_path = '/storage/' . $filePath;
            $fileModel->file_berkas=$fileName;
            $fileModel->user_id=$request->idUser;
            $fileModel->save();
        }
        $validateData['user_id'] = auth()->user()->id;
        NaikBerkala::create($validateData);
        Alert::success('Sukses', 'Data Kenaikan Gaji Berkala Berhasil Ditambahkan');
        return redirect()->route('index.berkala');
    }

    //Halaman Edit (Belum)
    //Fungsi Update (Belum)
    //Halaman Detail (Belum)
    //Fungsi hapus Belum(Belum)

    public function create()
    {

    }


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

}
