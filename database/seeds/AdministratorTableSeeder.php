<?php

use Illuminate\Database\Seeder;

class AdministratorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('administrator')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '17621131003',
            'password' => bcrypt('123456')
        ]);
    }
}
