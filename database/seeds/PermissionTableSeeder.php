<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $permissions = [

            'ContactUs',
            'services',
            'Add Services',
            'Delete Service',
            'Edit Service',
            'Show Service Attachment',
            'Project',
            'Add Project',
            'Delete Project',
            'Edit Project',
            'Show Project Attachment',
            'Positions',
            'Add Position',
            'Edit Position',
            'Delete Position',
            'Employees',
            'Add Employee',
            'Edit Employee',
            'Delete Employee',
            'Show Employee Attachment',
            'Gallery',
            'Users',
            'Add User',
            'Edit User',
            'Delete User',
            'Roles',
            'Add Role',
            'Delete Role',
            'Edit Role',
            'Show Roles',

        ];



        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);
        }
    }
}
