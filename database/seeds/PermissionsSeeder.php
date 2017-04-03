<?php

use Illuminate\Database\Seeder;
use Ultraware\Roles\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Permission::truncate();
    	
        $createUsersPermission = Permission::create([
		    'name' => 'Create users',
		    'slug' => 'create.users',
		    'description' => '', // optional
		]);

		$deleteUsersPermission = Permission::create([
		    'name' => 'Delete users',
		    'slug' => 'delete.users',
		]);
    }
}
