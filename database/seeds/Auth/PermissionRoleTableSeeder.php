<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        $admin = Role::create(['name' => config('access.users.admin_role')]);
       
     


        $permissions = [

            ['id' => 1, 'name' => 'user_management_access',],
            ['id' => 2, 'name' => 'user_management_create',],
            ['id' => 3, 'name' => 'user_management_edit',],
            ['id' => 4, 'name' => 'user_management_view',],
            ['id' => 5, 'name' => 'user_management_delete',],

            
            ['id' => 6, 'name' => 'subPackages_create',],
            ['id' => 7, 'name' => 'user_access',],
            ['id' => 8, 'name' => 'user_create',],
            ['id' => 9, 'name' => 'user_edit',],
            ['id' => 10, 'name' => 'user_view',],
            ['id' => 11, 'name' => 'user_delete',],

          
            ['id' => 12, 'name' => 'view backend',],

           
        ];

        foreach ($permissions as $item) {
            Permission::create($item);
        }



        $admin->syncPermissions(Permission::all());
      

        $this->enableForeignKeys();
    }
}
