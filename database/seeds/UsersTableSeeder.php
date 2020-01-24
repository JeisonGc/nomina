<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

 use MongoDB\BSON\ObjectID;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = 'insoftar';
        $user->password = Hash::make('insoftar');
        $user->client = new ObjectID("5e2b0b7621024d0671197514");
        $user->role = 'superuser';
        $user->save();
    }
}
