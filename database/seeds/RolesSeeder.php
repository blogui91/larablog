<?php

use Illuminate\Database\Seeder;
use Ultraware\Roles\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *n
     * @return void
     */
    public function run()
    {
    	Role::truncate();
		$adminRole = Role::create([
		    'name' => 'Admin',
		    'slug' => 'admin',
		    'description' => '', // optional
		    'level' => 1, // optional, set to 1 by default
		]);

		$userRegisteredRole = Role::create([
		    'name' => 'Registered user',
		    'slug' => 'registered.user',
		]);
    }
}
