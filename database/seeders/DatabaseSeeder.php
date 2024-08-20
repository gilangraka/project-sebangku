<?php

namespace Database\Seeders;

use App\Models\RefProduk;
use App\Models\RefStatus;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'Administrator',
        //     'email' => 'admin@gmail.com',
        // ]);

        // // Menentukan role dan permission
        // $list_role = ['administrator', 'normal_user'];
        // $list_permission = ['manage_produk', 'manage_user'];

        // $roles = [];
        // $permissions = [];

        // foreach ($list_role as $key => $value) {
        //     $roles[$key] = Role::create(['name' => $value]);
        // }
        // foreach ($list_permission as $key => $value) {
        //     $permissions[$key] = Permission::create(['name' => $value]);
        // }

        // $roles[0]->givePermissionTo($permissions[0]);
        // $roles[0]->givePermissionTo($permissions[1]);
        // $permissions[0]->assignRole($roles[0]);
        // $permissions[1]->assignRole($roles[0]);

        // $user = User::find(1);
        // $user->assignRole('administrator');
        // // Menentukan role dan permission Selesai

        // $list_status = ['Tidak Aktif', 'Aktif'];
        // foreach ($list_status as $value) {
        //     $ref_status = new RefStatus();
        //     $ref_status->nama_status = $value;
        //     $ref_status->save();
        // }
        RefProduk::factory()->count(20)->create();
    }
}
