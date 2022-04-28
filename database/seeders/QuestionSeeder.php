<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::truncate();

        $question = [
            'title'       => 'CFIT Subtest 1',
            'type'        => 'CFIT',
            'time'        => '120',
            'instruction' => 'There are 4 (four) boxes in which there are circles from the largest in order to the smallest. Starting from the picture in the first box to the third box, and the fourth box is empty which is the box that you have to find the answer to. Which answer choice is the most appropriate to fill in the blanks? The answer is c, because the size of the circle is getting smaller. Please select the letter c in the available answer choices.',
        ];

        Question::insert($question);
    }
}
