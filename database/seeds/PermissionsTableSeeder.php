<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users
        Permission::create([
            'name'        => 'Navegar usuarios',
            'slug'        => 'users.index',
            'description' => 'Lista y navega los usuarios del sistema'
        ]);
        Permission::create([
            'name'        => 'Ver usuarios',
            'slug'        => 'users.show',
            'description' => 'Ver en detalle los usuarios del sistema'
        ]);
        Permission::create([
            'name'        => 'Editar usuarios',
            'slug'        => 'users.edit',
            'description' => 'Editar cualquier dato de los usuarios del sistema'
        ]);
        Permission::create([
            'name'        => 'Eliminar usuarios',
            'slug'        => 'users.destroy',
            'description' => 'Eliminar usuarios del sistema'
        ]);

        //Roles
        Permission::create([
            'name'        => 'Navegar roles',
            'slug'        => 'roles.index',
            'description' => 'Lista y navega los roles del sistema'
        ]);
        Permission::create([
            'name'        => 'Ver roles',
            'slug'        => 'roles.show',
            'description' => 'Ver en detalle los roles del sistema'
        ]);
        Permission::create([
            'name'        => 'Crear roles',
            'slug'        => 'roles.create',
            'description' => 'Crear roles del sistema'
        ]);
        Permission::create([
            'name'        => 'Editar roles',
            'slug'        => 'roles.edit',
            'description' => 'Editar los roles del sistema'
        ]);
        Permission::create([
            'name'        => 'Eliminar roles',
            'slug'        => 'roles.destroy',
            'description' => 'Eliminar roles del sistema'
        ]);

        //Productos
        Permission::create([
            'name'        => 'Navegar productos',
            'slug'        => 'products.index',
            'description' => 'Lista y navega los productos del sistema'
        ]);
        Permission::create([
            'name'        => 'Ver productos',
            'slug'        => 'products.show',
            'description' => 'Ver en detalle los productos del sistema'
        ]);
        Permission::create([
            'name'        => 'Crear productos',
            'slug'        => 'products.create',
            'description' => 'Crear productos del sistema'
        ]);
        Permission::create([
            'name'        => 'Editar productos',
            'slug'        => 'products.edit',
            'description' => 'Editar los productos del sistema'
        ]);
        Permission::create([
            'name'        => 'Eliminar productos',
            'slug'        => 'products.destroy',
            'description' => 'Eliminar producto del sistema'
        ]);
    }
}
