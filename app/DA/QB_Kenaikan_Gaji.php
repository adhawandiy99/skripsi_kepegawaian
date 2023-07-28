<?php
namespace App\DA;
use Illuminate\Support\Facades\DB;
class QB_Kenaikan_Gaji
{
  
  public static function getById($id)
  {
    return DB::table('naik_berkalas as n')->select('n.*','g.gaji_pokok')->leftJoin('gajis as g', 'n.gaji_id', '=', 'g.id')->where('n.id', $id)->first();
  }
}