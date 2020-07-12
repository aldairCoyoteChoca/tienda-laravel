<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'          => 'Admin',
            'slug'          => 'admin',
            'description'   => 'Tiene acceso total del sistema',
            'special'       => 'all-access'
        ]);

        factory(App\User::class)->create()->each(function(App\User $user){
            $user->role()->attach([
                1
            ]);
        });
    }
}
