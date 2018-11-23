<?php

use App\Task;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::truncate();

        $faker = \Faker\Factory::create();



        for ($i = 0; $i < 50; $i++) {
            $user = \App\User::all()->random();

            $task = new Task([
                'title' => $faker->jobTitle,
                'description' => $faker->text,
            ]);

            $user->assignee()->save($task);
        }
    }
}
