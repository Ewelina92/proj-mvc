<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
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
        User::truncate();
        Task::truncate();

        User::create([
            'username' => 'Albus Dumbledore',
            'email' => 'albus@hogwarts.com',
            'password' => '$2y$10$UXIih9Y.jgs6fNplAas2IeW2g/QN3.9MCbtd3u33nJO4nbVRTnL4i', // test
        ]);

        User::create([
            'username' => 'Severus Snape',
            'email' => 'severus@hogwarts.com',
            'password' => '$2y$10$UXIih9Y.jgs6fNplAas2IeW2g/QN3.9MCbtd3u33nJO4nbVRTnL4i', // test
        ]);

        //User::factory(2)->create();

        Task::factory(3)->create([
            'user_id' => 1
        ]);

        Task::factory(3)->create([
            'user_id' => 2
        ]);
    }
}
