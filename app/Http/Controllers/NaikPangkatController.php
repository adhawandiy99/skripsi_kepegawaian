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
use Illuminate\Support\Facades\Auth;
use App\DA\QB_Kepegawaian;
use App\DA\QB_Kenaikan_pangkat;

class NaikPangkatController extends Controller
{
    //--ADMIN--
    //Menu Kenaikan Pangkat
    public function naikPangkatMenuAdmin()
    {
        return view('pegawai.admin.kenaikan.naik-pangkat.menu');
    }

    //Halaman Data Kenaikan Pangkat PNS Jabtan Reguler Eselon Struktural
    public function AdminStruktural()
    {
        $naikPangkat = NaikPangkat::where('jenis_usulan', 1)->get();
        return view('pegawai.admin.kenaikan.naik-pangkat.eselon-struktural.index', compact('naikPangkat'));
    }
    public function approvalStruktural($kenaikan_id)
    {
        $kenaikan = QB_Kenaikan_pangkat::getById($kenaikan_id);
        $user = QB_Kepegawaian::getPegawaiByID($kenaikan->user_id);
        $pangkat = Pangkat::get();
        return view('pegawai.admin.kenaikan.naik-pangkat.eselon-struktural.approval', compact('user','pangkat', 'kenaikan'));
    }
    public function saveApprovalStruktural($kenaikan_id, Request $req)
    {
        $validateData = $req->validate([
            'ket' => 'required'
        ]);
        // dd($validateData);
        NaikPangkat::where('id', $kenaikan_id)->update($validateData);
        Alert::success('Sukses', 'Berhasil Submit approval');
        return redirect()->route('index.struktural');
    }

    

    //Halaman Data Kenaikan Pangkat PNS Jabtan Pelaksana/Staf
    public function AdminPS()
    {

        $naikPangkat = NaikPangkat::where('jenis_usulan', 2)->get();
        return view('pegawai.admin.kenaikan.naik-pangkat.pelaksana_staf.index', compact('naikPangkat'));

    }
    public function approvalPS($kenaikan_id)
    {
        $kenaikan = QB_Kenaikan_pangkat::getById($kenaikan_id);
        $user = QB_Kepegawaian::getPegawaiByID($kenaikan->user_id);
        $pangkat = Pangkat::get();
        return view('pegawai.admin.kenaikan.naik-pangkat.pelaksana_staf.approval', compact('user','pangkat', 'kenaikan'));
    }
    public function saveApprovalPS($kenaikan_id, Request $req)
    {
        $validateData = $req->validate([
            'ket' => 'required'
        ]);
        // dd($validateData);
        NaikPangkat::where('id', $kenaikan_id)->update($validateData);
        Alert::success('Sukses', 'Berhasil Submit approval');
        return redirect()->route('index.ps');
    }

    //Halaman Data Kenaikan Pangkat PNS Jabtan Pelaksana/Staf Penyesuaian Ijazah
    public function AdminPSI()
    {

        $naikPangkat = NaikPangkat::where('jenis_usulan', 3)->get();
        return view('pegawai.admin.kenaikan.naik-pangkat.pelaksana_staf_ijazah.index',compact('naikPangkat'));

    }
    public function approvalPSI($kenaikan_id)
    {
        $kenaikan = QB_Kenaikan_pangkat::getById($kenaikan_id);
        $user = QB_Kepegawaian::getPegawaiByID($kenaikan->user_id);
        $pangkat = Pangkat::get();
        return view('pegawai.admin.kenaikan.naik-pangkat.pelaksana_staf_ijazah.approval', compact('user','pangkat', 'kenaikan'));
    }
    public function saveApprovalPSI($kenaikan_id, Request $req)
    {
        $validateData = $req->validate([
            'ket' => 'required'
        ]);
        // dd($validateData);
        NaikPangkat::where('id', $kenaikan_id)->update($validateData);
        Alert::success('Sukses', 'Berhasil Submit approval');
        return redirect()->route('index.psi');
    }

    //Halaman Data Kenaikan Pangkat PNS Jabtan Fungsional Tertentu
    public function AdminFT()
    {

        $naikPangkat = NaikPangkat::where('jenis_usulan', 4)->get();
        return view('pegawai.admin.kenaikan.naik-pangkat.fungsional_tertentu.index', compact('naikPangkat'));

    }
    public function approvalFT($kenaikan_id)
    {
        $kenaikan = QB_Kenaikan_pangkat::getById($kenaikan_id);
        $user = QB_Kepegawaian::getPegawaiByID($kenaikan->user_id);
        $pangkat = Pangkat::get();
        return view('pegawai.admin.kenaikan.naik-pangkat.fungsional_tertentu.approval', compact('user','pangkat', 'kenaikan'));
    }
    public function saveApprovalFT($kenaikan_id, Request $req)
    {
        $validateData = $req->validate([
            'ket' => 'required'
        ]);
        // dd($validateData);
        NaikPangkat::where('id', $kenaikan_id)->update($validateData);
        Alert::success('Sukses', 'Berhasil Submit approval');
        return redirect()->route('index.ft');
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
        $naikPangkat = NaikPangkat::where('user_id', $user)->where('jenis_usulan', 1)->get();
        return view('pegawai.pns.kenaikan.naik_pangkat.eselon_struktural.riwayat',compact('naikPangkat'));
    }

    //Halaman Tambah Data Kenaikan Pangkat Jabatan Reguler Eselon Struktural
    public function formStruktural($kenaikan_id)
    {
        $user_id = auth()->id();
        $user = QB_Kepegawaian::getPegawaiByID($user_id);
        $pangkat = Pangkat::get();
        $kenaikan = QB_Kenaikan_pangkat::getById($kenaikan_id);
        // dd($kenaikan,$kenaikan_id);
        return view('pegawai.pns.kenaikan.naik_pangkat.eselon_struktural.create', compact('user','pangkat', 'kenaikan'));
    }
    //delete all usulan by id
    public function deleteUsulanKenaikan(Request $req)
    {
        // dd($req->id);
        QB_Kenaikan_pangkat::deleteUsulan($req->id);
        Alert::success('Sukses', 'Berhasil menghapus usulan');
        return redirect()->back();
    }

    //Fungsi Simpan Data Kenaikan Pangkat Jabatan Reguler Eselon Struktural
    public function storeStruktrural($kenaikan_id, Request $request)
    {
        if(QB_Kenaikan_pangkat::getById($kenaikan_id)){
            //todo update
             $validateData = $request->validate([
                'pangkat_id' => 'required',
                'mulai_tanggal' => 'required',
                'naik_selanjutnya' => 'required',
                'tgl_usulan' => 'required',
                'jenis_usulan' => 'required',
                'file_pangkat' => 'mimes:rar|max:2048'
            ]);
            $validateData['user_id'] = auth()->user()->id;
            NaikPangkat::where('id',$kenaikan_id)->update($validateData);
        }else{
            //todo insert
            $validateData = $request->validate([
                'pangkat_id' => 'required',
                'mulai_tanggal' => 'required',
                'naik_selanjutnya' => 'required',
                'tgl_usulan' => 'required',
                'jenis_usulan' => 'required',
                'file_pangkat' => 'required|mimes:rar|max:2048'
            ]);
            $validateData['user_id'] = auth()->user()->id;
            $kenaikan_id = NaikPangkat::create($validateData)->id;
        }

        if($request->file('file_pangkat')){
            $fileName = $kenaikan_id.'.'.$request->file('file_pangkat')->getClientOriginalExtension();
            $request->file('file_pangkat')->storeAs('uploads/file_pangkat', $fileName, 'public');
        }
        Alert::success('Sukses', 'Data Usul Kenaikan Pangkat Jabatan Eselon Struktural Berhasil Disimpan');
        return redirect()->route('menu.pangkat.struktural');
    }

    //Halaman Edit (Belum Ada)/done
    //Fungsi Update (Belum Ada)/done
    //Halaman Detail (Belum Ada/done


    // ---Jabatan Pelaksana/Staf----
    //Halaman Riwayat
    public function pangkatPelaksanaStaf()
    {
        $user = auth()->id();
        $naikPangkat = NaikPangkat::where('user_id', $user)->where('jenis_usulan', 2)->get();
        return view('pegawai.pns.kenaikan.naik_pangkat.pelaksana_staf.riwayat',compact('naikPangkat'));
    }

    //Halaman Tambah Data Kenaikan Pangkat Jabatan Pelaksana/Staf
    public function formPelaksanaStaf($kenaikan_id)
    {
        $user_id = auth()->id();
        $user = QB_Kepegawaian::getPegawaiByID($user_id);
        $pangkat = Pangkat::get();
        $kenaikan = QB_Kenaikan_pangkat::getById($kenaikan_id);
        return view('pegawai.pns.kenaikan.naik_pangkat.pelaksana_staf.create', compact('pangkat', 'user', 'kenaikan'));
    }
    public function simpanPelaksanaStaf($kenaikan_id, Request $request)
    {
        if(QB_Kenaikan_pangkat::getById($kenaikan_id)){
            //todo update
             $validateData = $request->validate([
                'pangkat_id' => 'required',
                'mulai_tanggal' => 'required',
                'naik_selanjutnya' => 'required',
                'tgl_usulan' => 'required',
                'jenis_usulan' => 'required',
                'file_pangkat' => 'mimes:rar|max:2048'
            ]);
            $validateData['user_id'] = auth()->user()->id;
            NaikPangkat::where('id',$kenaikan_id)->update($validateData);
        }else{
            //todo insert
            $validateData = $request->validate([
                'pangkat_id' => 'required',
                'mulai_tanggal' => 'required',
                'naik_selanjutnya' => 'required',
                'tgl_usulan' => 'required',
                'jenis_usulan' => 'required',
                'file_pangkat' => 'required|mimes:rar|max:2048'
            ]);
            $validateData['user_id'] = auth()->user()->id;
            $kenaikan_id = NaikPangkat::create($validateData)->id;
        }

        if($request->file('file_pangkat')){
            $fileName = $kenaikan_id.'.'.$request->file('file_pangkat')->getClientOriginalExtension();
            $request->file('file_pangkat')->storeAs('uploads/file_pangkat', $fileName, 'public');
        }
        Alert::success('Sukses', 'Data Usul Kenaikan Pangkat Jabatan Pelaksana Staff Berhasil Disimpan');
        return redirect()->route('menu.pangkat.pestaf');
    }

    //Fungsi Simpan (Belum Ada)/done
    //Halaman Edit (Belum Ada)/done
    //Fungsi Update (Belum Ada)/done
    //Halaman Detail (Belum Ada/done



    // ---Jabatan Reguler Jabatan Pelaksana/Staf Penyesuaian Ijazah----
    //Halaman Riwayat Kenaikan Pangkat Jabatan Pelaksana/Staf Penyesuaian Ijazah
    public function pangkatPeStafijazah()
    {
        $naikPangkat = $naikPangkat = NaikPangkat::where('user_id', auth()->id())->where('jenis_usulan', 3)->get();
        return view('pegawai.pns.kenaikan.naik_pangkat.pelaksana_staf_ijazah.riwayat',compact('naikPangkat'));
    }

    //Halaman Tambah Data Kenaikan Pangkat Jabatan Pelaksana/Staf Penyesuaian Ijazah
    public function formPSI($kenaikan_id)
    {
        $user = QB_Kepegawaian::getPegawaiByID(auth()->id());
        // dd($user);
        $pangkat = Pangkat::get();
        $kenaikan = QB_Kenaikan_pangkat::getById($kenaikan_id);
        return view('pegawai.pns.kenaikan.naik_pangkat.pelaksana_staf_ijazah.create', compact('pangkat', 'user', 'kenaikan'));
    }

    public function simpanPSI($kenaikan_id, Request $request)
    {
        if(QB_Kenaikan_pangkat::getById($kenaikan_id)){
            //todo update
             $validateData = $request->validate([
                'pangkat_id' => 'required',
                'mulai_tanggal' => 'required',
                'naik_selanjutnya' => 'required',
                'tgl_usulan' => 'required',
                'jenis_usulan' => 'required',
                'file_pangkat' => 'mimes:rar|max:2048'
            ]);
            $validateData['user_id'] = auth()->user()->id;
            NaikPangkat::where('id',$kenaikan_id)->update($validateData);
        }else{
            //todo insert
            $validateData = $request->validate([
                'pangkat_id' => 'required',
                'mulai_tanggal' => 'required',
                'naik_selanjutnya' => 'required',
                'tgl_usulan' => 'required',
                'jenis_usulan' => 'required',
                'file_pangkat' => 'required|mimes:rar|max:2048'
            ]);
            $validateData['user_id'] = auth()->user()->id;
            $kenaikan_id = NaikPangkat::create($validateData)->id;
        }

        if($request->file('file_pangkat')){
            $fileName = $kenaikan_id.'.'.$request->file('file_pangkat')->getClientOriginalExtension();
            $request->file('file_pangkat')->storeAs('uploads/file_pangkat', $fileName, 'public');
        }
        Alert::success('Sukses', 'Data Usul Kenaikan Pangkat Jabatan Pelaksana/Staf Penyesuaian Ijazah Berhasil Disimpan');
        return redirect()->route('menu.pangkat.pestafijazah');
    }
    //Fungsi Simpan (Belum Ada)/done
    //Halaman Edit (Belum Ada)/done
    //Fungsi Update (Belum Ada)/done
    //Halaman Detail (Belum Ada/done


    // ---Jabatan Reguler Jabatan Fungsional Tertentu----
    //Halaman Riwayat Kenaikan Pangkat Jabatan Funsional Tertentu
    public function naikPangkatFt()
    {
        // $user = auth()->id();
        // $naikPangkat = NaikPangkatFT::where('user_id', $user)->get();
        $naikPangkat = $naikPangkat = NaikPangkat::where('user_id', auth()->id())->where('jenis_usulan', 4)->get();
        return view('pegawai.pns.kenaikan.naik_pangkat.fungsional_tertentu.riwayat',compact('naikPangkat'));
    }

    //Halaman Tambah Data Kenaikan Pangkat Jabatan Fungsional tertentu
    public function formFt($kenaikan_id)
    {
        $user = QB_Kepegawaian::getPegawaiByID(auth()->id());
        // dd($user);
        $pangkat = Pangkat::get();
        $kenaikan = QB_Kenaikan_pangkat::getById($kenaikan_id);
        return view('pegawai.pns.kenaikan.naik_pangkat.fungsional_tertentu.create', compact('pangkat', 'user', 'kenaikan'));
    }
    public function insertOrUpdateFt($kenaikan_id, Request $request)
    {
        if(QB_Kenaikan_pangkat::getById($kenaikan_id)){
            //todo update
             $validateData = $request->validate([
                'pangkat_id' => 'required',
                'mulai_tanggal' => 'required',
                'naik_selanjutnya' => 'required',
                'tgl_usulan' => 'required',
                'jenis_usulan' => 'required',
                'file_pangkat' => 'mimes:rar|max:2048'
            ]);
            $validateData['user_id'] = auth()->user()->id;
            NaikPangkat::where('id',$kenaikan_id)->update($validateData);
        }else{
            //todo insert
            $validateData = $request->validate([
                'pangkat_id' => 'required',
                'mulai_tanggal' => 'required',
                'naik_selanjutnya' => 'required',
                'tgl_usulan' => 'required',
                'jenis_usulan' => 'required',
                'file_pangkat' => 'required|mimes:rar|max:2048'
            ]);
            $validateData['user_id'] = auth()->user()->id;
            $kenaikan_id = NaikPangkat::create($validateData)->id;
        }

        if($request->file('file_pangkat')){
            $fileName = $kenaikan_id.'.'.$request->file('file_pangkat')->getClientOriginalExtension();
            $request->file('file_pangkat')->storeAs('uploads/file_pangkat', $fileName, 'public');
        }
        Alert::success('Sukses', 'Data Usul Kenaikan Pangkat Jabatan Fungsional Tertentu Berhasil Disimpan');
        return redirect()->route('menu.pangkat.ft');
    }
    //Fungsi Simpan (Belum Ada)/done
    //Halaman Edit (Belum Ada)/done
    //Fungsi Update (Belum Ada)/done
    //Halaman Detail (Belum Ada/done

}
