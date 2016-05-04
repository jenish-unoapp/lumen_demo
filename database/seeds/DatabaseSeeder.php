<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('UsersTableSeeder');
    }
}

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        for ($i = 0; $i < 5; $i++) {
            $user = factory(App\User::class)->make();
            $user->save();
            $user_meta = factory(App\Models\UserMeta::class)->make();
            $user_meta->ZUserId = $user->Id;
            $user_meta->save();
        }
    }
}
