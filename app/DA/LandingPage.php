<?php
namespace App\DA;
use Illuminate\Support\Facades\DB;
class LandingPage
{
  public static function getById($id)
  {
    return DB::table('landing_page')->where('id', $id)->first();
  }
  public static function insert($field)
  {
    return DB::table('landing_page')->insertGetId($field);
  }
  public static function update($id,$field)
  {
    DB::table('landing_page')->where('id', $id)->update($field);
  }
}