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
        $connection = new \App\ConfigurationClient();
        $connection->name = 'Insoftar';
        $connection->url_icon = "insoftar.png";
        $connection->title = 'Insoftar';
        $connection->connection = "insoftar";
        $connection->email = "test@gmail.com";
        $connection->save();

        $user = new User();
        $user->username = 'insoftar';
        $user->password = Hash::make('insoftar');
        $user->client = $connection->id;
        $user->role = 'superuser';
        $user->save();
    }
}
