<?php

namespace Database\Seeders;

use App\Models\Tutor;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tutor = [
            [
                'tutor_name' => 'tutor',
                'email' => 'tutor@gmail.com',
                'is_tutor' => '1',
                'password' => bcrypt('12345678')

            ]
        ];
        foreach($tutor as $key => $value){
            Tutor::create($value);
        }
    }
}
