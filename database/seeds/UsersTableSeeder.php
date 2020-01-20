<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->id = 1;
        $role->name = 'admin';
        $role->permissions = ['users'];
        $role->save();

        $role = new Role();
        $role->id = 2;
        $role->name = 'users';
        $role->permissions = [];
        $role->save();


        $user = new User();
        $user->username = 'admin';
        $user->password = Hash::make('admin');
        $user->role_id = 1;
        $user->save();
        $user->delete();

        $user = new User();
        $user->username = 'user';
        $user->password = Hash::make('user');
        $user->role_id = 2;
        $user->save();
    }
}
