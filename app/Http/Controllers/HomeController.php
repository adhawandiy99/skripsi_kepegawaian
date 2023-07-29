<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use App\DA\KirimEmail;
use App\DA\QB_Kenaikan_pangkat;
use App\DA\QB_Kenaikan_Gaji;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // contoh kirim email, use diatas
        // $to_email = "kesiapa@gmail.com";
        // $subject = "Notifikasi aja";
        // $html_content = "<html><body>Hello World</body></html>";
        // KirimEmail::send($to_email,$subject,$html_content);

        $kenaikan_pangkat = QB_Kenaikan_pangkat::getAll();
        return view('home', compact('kenaikan_pangkat'));
    }
    public function download(Request $req)
    {
        $file_path = public_path().'/storage/uploads/'.$req->downloadpath;
        return response()->download($file_path, $req->downloadname);
    }
}
