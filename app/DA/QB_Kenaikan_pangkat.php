<?php
namespace App\DA;
use Illuminate\Support\Facades\DB;
class QB_Kenaikan_pangkat
{
  //store data ada di eloquent
  
  public static function deleteUsulan($id)
  {
    DB::table('naik_pangkats')->where('id', $id)->delete();
  }
  public static function getById($id)
  {
    return DB::table('naik_pangkats as n')
      ->leftJoin('pangkats as p', 'n.pangkat_id','=','p.id_pangkat')->where('n.id', $id)->first();
  }
  public static function getAllByUserUsulan($user_id,$jenis_usulan)
  {
    return DB::table('naik_pangkats')->where('user_id', $user_id)->where('jenis_usulan', $jenis_usulan)->get();
  }
}