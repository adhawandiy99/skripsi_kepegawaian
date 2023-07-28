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

        $validateData = $request->validate([
            'pangkat_id' => 'required',
            'mulai_tanggal' => 'required',
            'naik_selanjutnya' => 'required',
            'tgl_usulan' => 'required',
            'jenis_usulan' => 'required',
        ]);
        $validateData['user_id'] = auth()->user()->id;
        if(QB_Kenaikan_pangkat::getById($kenaikan_id)){
            //todo update
            NaikPangkat::where('id',$kenaikan_id)->update($validateData);
        }else{
            //todo insert
            NaikPangkat::create($validateData);
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
        $validateData = $request->validate([
            'pangkat_id' => 'required',
            'mulai_tanggal' => 'required',
            'naik_selanjutnya' => 'required',
            'tgl_usulan' => 'required',
            'jenis_usulan' => 'required',
        ]);
        $validateData['user_id'] = auth()->user()->id;
        if(QB_Kenaikan_pangkat::getById($kenaikan_id)){
            //todo update
            NaikPangkat::where('id',$kenaikan_id)->update($validateData);
        }else{
            //todo insert
            NaikPangkat::create($validateData);
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
        $validateData = $request->validate([
            'pangkat_id' => 'required',
            'mulai_tanggal' => 'required',
            'naik_selanjutnya' => 'required',
            'tgl_usulan' => 'required',
            'jenis_usulan' => 'required',
        ]);
        $validateData['user_id'] = auth()->user()->id;
        if(QB_Kenaikan_pangkat::getById($kenaikan_id)){
            //todo update
            NaikPangkat::where('id',$kenaikan_id)->update($validateData);
        }else{
            //todo insert
            NaikPangkat::create($validateData);
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
    public function insertOrUpdateFt($kenaikan_id, Request $req)
    {
        $validateData = $req->validate([
            'pangkat_id' => 'required',
            'mulai_tanggal' => 'required',
            'naik_selanjutnya' => 'required',
            'tgl_usulan' => 'required',
            'jenis_usulan' => 'required',
        ]);
        $validateData['user_id'] = auth()->user()->id;
        if(QB_Kenaikan_pangkat::getById($kenaikan_id)){
            //todo update
            NaikPangkat::where('id',$kenaikan_id)->update($validateData);
        }else{
            //todo insert
            NaikPangkat::create($validateData);
        }
        Alert::success('Sukses', 'Data Usul Kenaikan Pangkat Jabatan Fungsional Tertentu Berhasil Disimpan');
        return redirect()->route('menu.pangkat.ft');
    }
    //Fungsi Simpan (Belum Ada)/done
    //Halaman Edit (Belum Ada)/done
    //Fungsi Update (Belum Ada)/done
    //Halaman Detail (Belum Ada/done

}
