<?php

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $tests = factory(\App\Models\Test::class, 3)->create();

        foreach ($tests as $test) {
            $questions = factory(\App\Models\Question::class, random_int(10, 15))->create();
            foreach ($questions as $question) {
                $question->test()->associate($test);
                $question->save();
                $isRight = false;
                $isAlreadyRight = false;
                for ($i = 0; $i < rand(3, 5); $i++)
                {
                    if ($isAlreadyRight)
                    {
                        $isRight = false;
                    }
                    else
                    {
                        $isRight = $faker->randomElement([true, false]);
                        if ($isRight)
                        {
                            $isAlreadyRight = true;
                        }
                    }
                    //$isRight = $isRight ? false : $faker->randomElement([true, false]);
                    $question->answers()->create([
                        'answer_text' => $faker->realText(50),
                        'is_right' => $isRight,
                    ]);
                }
            }
        }
    }
}
