<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Comment::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            \App\Comment::create([
                'comment' => $faker->text(255),
                'user_id' => \App\User::all()->random()->id,
                'task_id' => \App\Task::all()->random()->id
            ]);
        }
    }
}
