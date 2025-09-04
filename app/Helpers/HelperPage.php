<?php

namespace App\Helpers;

//laravel
use Illuminate\Support\Facades\DB;

//models
use App\Models\System\ConfigurationModel;

use App\Models\DataMaster\PTModel;
use App\Models\DataMaster\ProgramStudiModel;
use App\Models\DataMaster\WilayahModel;
use App\Models\DataMaster\WilayahDesaModel;

class HelperPage extends Helpers
{
  /**
   * daftar semester
   */
  private static $daftar_semester = [
    '' => '- PILIH SEMESTER -',
    1 => 'GANJIL',
    2 => 'GENAP',
    3 => 'PENDEK',		
  ];	
  
  /**
   * level wilayah mahasiswa
   */
  private static $daftar_level_wilayah = [
    '' => '- PILIH LEVEL WILAYAH -',
    '0' => 'NEGARA',
    '1' => 'PROPINSI',
    '2' => 'KABUPATEN / KOTA',
    '3' => 'KECAMATAN',    
  ];
  /**
   * digunakan untuk mendapatkan kode perguruan tinggi
   */
  public static function getKodePT()
  {
    return ConfigurationModel::getCache('KODE_PT');
  }
  /**
   * digunakan untuk mendapatkan nama perguruan tinggi
   */
  public static function getNamaPT()
  {
    return ConfigurationModel::getCache('NAMA_PT');
  }
  /**
   * digunakan untuk mendapatkan nama alias perguruan tinggi
   */
  public static function getNamaPTAlias()
  {
    return ConfigurationModel::getCache('NAMA_PT_ALIAS');
  }
  /**
   * digunakan untuk mendapatkan data perguruan tinggi
  */
  public static function getDataPT($kode_pt, $field = null)
  {
    $table_name_pt = PTModel::getTableName();
    $data_pt = PTModel::where('kode_pt', $kode_pt)->first();

    if($field === null)
    {
      return $data_pt;
    }
    else
    {
      return $data_pt->$field ?? null;
    }
  }	

  /**
   * digunakan untuk mendapatkan program studi
  */
  public static function getProgramStudi($id_prodi = null, $all = null)
  {
    $daftar_prodi = request()->session()->get('DAFTAR_PRODI');    
    if ($id_prodi === null && $all === null)
    {
      return $daftar_prodi;
    }
    elseif ($id_prodi === null && $all != null)
    {
      $daftar_prodi = array($all => 'KESELURUHAN PRODI') + $daftar_prodi;
      return $daftar_prodi;
    }
    else
    {
      return isset($daftar_prodi[$id_prodi]) ? $daftar_prodi[$id_prodi] : NULL;
    }			
  }
  /**
   * digunakan untuk mendapatkan semester
  */
  public static function getSemester($semester = null)
  {
    if($semester === null)
    {
      return HelperPage::$daftar_semester;
    }
    else
    {
      return isset(HelperPage::$daftar_semester[$semester]) ? HelperPage::$daftar_semester[$semester] : NULL;
    }			
  }

  /**
   * digunakan untuk mendapatkan kelas (untuk keuangan, spmb, dll)
   * @param int $idkelas
   * @return array
  */
  public static function getKelas($idkelas = null)
  {
    $daftar_kelas = request()->session()->get('DAFTAR_KELAS');    
    if($idkelas === null)
    {
      return $daftar_kelas;
    }
    else
    {
      return isset($daftar_kelas[$idkelas]) ? $daftar_kelas[$idkelas] : NULL;
    }			
  }
 
  /**
   * digunakan untuk mendapatkan kelas
  */
  public static function getKelasFeeder($idkelas = null)
  {
    $daftar_kelas = request()->session()->get('DAFTAR_KELAS');    
    if($idkelas === null)
    {
      return HelperPage::$daftar_kelas_feeder;
    }
    else
    {
      return HelperPage::$daftar_kelas_feeder[$idkelas];
    }			
  }

  /**
   * digunakan untuk mendapatkan tahun akademik
  */
  public static function getTA($ta = null)
  {
    $daftar_ta = request()->session()->get('DAFTAR_TA');    
    if($ta === null)
    {
      return $daftar_ta;
    }
    else
    {
      return isset($daftar_ta[$ta]) ? $daftar_ta[$ta] : NULL;
    }			
  }
  /**
   * digunakan untuk mendapatkan tahun akademik / semester
   */
  public static function getTahunSemester($ta_semester = null)
  {
    $daftar_ta_semester = request()->session()->get('DAFTAR_TA_SEMESTER');    
    
    if($ta_semester === null)
    {
      return $daftar_ta_semester;
    }
    else
    {
      return isset($daftar_ta_semester[$ta_semester]) ? $daftar_ta_semester[$ta_semester] : NULL;
    }			
  }
  /**
   * digunakan untuk mendapatkan tahun masuk / angkatan / tahun pendaftaran
  */
  public static function getTahunMasuk($tahun_masuk = null, $fromta = -1)
  {
    if($fromta > 0)
    {
      $daftar_ta = request()->session()->get('DAFTAR_TAHUN_MASUK');
      $daftar_tahun_masuk = [];
      foreach($daftar_ta as $k=>$v)
      {
        if($k <= $fromta)
        {
          $daftar_tahun_masuk[$k] = $v; 
        }        
      }
    }
    else
    {
      $daftar_tahun_masuk = request()->session()->get('DAFTAR_TAHUN_MASUK');    
    }

    if ($tahun_masuk === null)
    {
      return $daftar_tahun_masuk;
    }
    else
    {
      return isset($daftar_tahun_masuk[$ta]) ? $daftar_tahun_masuk[$ta] : NULL;
    }			
  }
  /**
   * digunakan untuk mendapatkan status mahasiswa
  */
  public static function getStatus($k_status = null)
  {
    $daftar_status = request()->session()->get('DAFTAR_STATUS_MHS');    
    if($k_status === null)
    {
      return $daftar_status;
    }
    else
    {
      return isset($daftar_status[$k_status]) ? $daftar_status[$k_status] : NULL;
    }			
  }

  /**
   * digunakan untuk mendapatkan default prodi
  */
  public static function getDefaultProdi() {
    return request()->session()->get('DEFAULT_PRODI');
  }
  /**
   * digunakan untuk mendapatkan default tahun akademik
  */
  public static function getDefaultTA() {
    return request()->session()->get('DEFAULT_TA');
  }
  /**
   * digunakan untuk mendapatkan default tahun pendaftaran
  */
  public static function getDefaultTAPendaftaran() {
    return request()->session()->get('DEFAULT_TAHUN_PENDAFTARAN');
  }
  /**
   * digunakan untuk mendapatkan default semester
  */
  public static function getDefaultSemester() {
    return request()->session()->get('DEFAULT_SEMESTER');
  }
  /**
   * digunakan untuk mendapatkan default kelas
  */
  public static function getDefaultKelas() {
    return request()->session()->get('DEFAULT_KELAS');		
  }
  /**
   * digunakan untuk mendapatkan level wilayah
   */
  public static function getLevelWilayah($level = null)
  {
    if(is_null($level))
    {
      return self::$daftar_level_wilayah;
    }
    else
    {
      return self::$daftar_level_wilayah[$level];
    }
  }
  /**
   * digunakan untuk mendapatkan data wilayah
   * @param int $id_wilayah
   * @param int $level
   * @return object
  */
  public static function getWilayah($id_wilayah = null, $level = 3)
  {
    $table_name_wilayah = WilayahModel::getTableName();
    
    $data_wilayah = DB::table("$table_name_wilayah AS a")
    ->select(DB::raw("
      a.id_wilayah,
      c.nama_wilayah AS prov_nama,
      b.nama_wilayah AS kab_nama,
      a.nama_wilayah AS kec_nama      
    "))
    ->leftJoin("$table_name_wilayah AS b", 'a.id_induk_wilayah', 'b.id_wilayah')
    ->leftJoin("$table_name_wilayah AS c", 'b.id_induk_wilayah', 'c.id_wilayah')
    ->where('a.id_level_wilayah', $level)
    ->where("a.id_wilayah", $id_wilayah)
    ->first();

    return $data_wilayah;
  }
  /**
   * digunakan untuk insert data desa    
   * @param int $id_wilayah (kecamata=)
   * @param string $nama_desa
  */
  public static function insertWilayahDesa($id_wilayah, $nama_desa)
  {
    $data_desa = WilayahDesaModel::where('id_wilayah', $id_wilayah)
    ->orderBy('id_desa', 'desc')
    ->first();

    if(is_null($data_desa))
    {
      $id_desa = $id_wilayah . '001';
    }
    else
    {
      $id_desa = $data_desa->id_desa + 1;
    }
    $desa_inserted = WilayahDesaModel::create([
      'id_desa' => $id_desa,
      'id_wilayah' => $id_wilayah,
      'nama_desa' => $nama_desa,
    ]);

    return $desa_inserted;
  } 
}
