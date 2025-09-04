<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $tableNames = config('permission.table_names');

    DB::statement("DELETE FROM {$tableNames['roles']}");
    DB::statement("ALTER TABLE {$tableNames['roles']} AUTO_INCREMENT = 1;");
    DB::table($tableNames['roles'])->insert([
      [
        'name' => 'admin',
        'guard_name' => 'web',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ],
      [
        'name' => 'admin',
        'guard_name' => 'api',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ],
      [
        'name' => 'pokdarwis',
        'guard_name' => 'web',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ],
      [
        'name' => 'pokdarwis',
        'guard_name' => 'api',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ],
      [
        'name' => 'wisatawan',
        'guard_name' => 'web',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ],
      [
        'name' => 'wisatawan',
        'guard_name' => 'api',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ],      
    ]);

    $role = Role::findByName('pokdarwis');
    $records = [
      'DASHBOARD_SHOW',      
    ];
    $role->syncPermissions($records);

    $role = Role::findByName('wisatawan');
    $records = [
      'DASHBOARD_SHOW',      
    ];
    $role->syncPermissions($records);
  }
}
