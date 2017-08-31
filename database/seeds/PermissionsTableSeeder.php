<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'create',
                'display_name' => 'Create Record',
                'description' => 'Allow admin to create a new DB record'
            ],
            [
                'name' => 'edit',
                'display_name' => 'Edit Record',
                'description' => 'Allow admin to edit an existing DB record'
            ],
            [
                'name' => 'delete',
                'display_name' => 'Delete Record',
                'description' => 'Allow admin to delete an existing DB record'
            ],
            [
                'name' => 'admins',
                'display_name' => 'Manage Admins',
                'description' => 'Allow admin to manage system admins'
            ]
        ];

        foreach ($permissions as $key => $value) {
            Permission::create($value);
        }
    }
}
