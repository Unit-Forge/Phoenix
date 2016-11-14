<?php

use Illuminate\Database\Seeder;
use Phoenix\Models\Auth\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Super Admin
        $admin = new \Phoenix\Models\User();
        $admin->email = 'guillermo@unit-forge.com';
        $admin->password = bcrypt('0WXRXDYEiyBf');
        $admin->save();

        // Create Roles
        $owner = new Role();
        $owner->name         = 'superadmin';
        $owner->display_name = 'Super Admin'; 
        $owner->description  = 'All permissions granted.';
        $owner->save();

        $mod = new Role();
        $mod->name         = 'app';
        $mod->display_name = 'Applications Moderator'; 
        $mod->description  = 'User is allowed to manage and edit applications.';
        $mod->save();

        $mod = new Role();
        $mod->name         = 'event';
        $mod->display_name = 'Events Moderator'; 
        $mod->description  = 'User is allowed to manage and edit events on the calendar.';
        $mod->save();
        
        $mod = new Role();
        $mod->name         = 'records';
        $mod->display_name = 'Records Moderator';
        $mod->description  = 'User is allowed to manage and edit unit files and structure.';
        $mod->save();

        $mod = new Role();
        $mod->name         = 'documentation';
        $mod->display_name = 'Documentations Moderator';
        $mod->description  = 'User is allowed to manage and edit documentation.';
        $mod->save();


        $mod = new Role();
        $mod->name         = 'member';
        $mod->display_name = 'Unit Member'; 
        $mod->description  = 'User has activated their account and have the default role for a registered member.';
        $mod->save();

        // Attach Role to Super User
        $admin->attachRole($owner);
    }
}
