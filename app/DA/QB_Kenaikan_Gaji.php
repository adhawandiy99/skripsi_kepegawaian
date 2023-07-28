<?php
namespace App\DA;
use Illuminate\Support\Facades\DB;
class QB_Kenaikan_Gaji
{
  
  public static function getById($id)
  {
    return DB::table('naik_berkalas')->where('id', $id)->first();
  }
}