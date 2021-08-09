<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = new App\User();
        $admin->name = "admin";
        $admin->email = "admin@gmail.com";
        $admin->password = Hash::make('12345678');
        $admin->type = "admin";
        $admin->phone = "012345";
        $admin->dob = "1959-12-13";
        $admin->address = "Yangon";
        $admin->profile = "Sunflower_from_Silesia2.jpg";
        $admin->created_user_id = 1;
        $admin->save();


        // $this->call(UserSeeder::class);
        factory(App\User::class, 10)->create();
        factory(App\Post::class, 20)->create();
    }
}
