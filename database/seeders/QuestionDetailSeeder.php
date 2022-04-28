<?php

namespace Database\Seeders;

use App\Models\QuestionDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionDetail::truncate();

        $questionDetails =  [
            [
                'question_id'    => 1,
                'question_image' => 'question01651155441.jpeg',
                'answer_image'   => 'answer01651155441.jpeg',
                'answer'         => 'B',
            ],
            [
                'question_id'    => 1,
                'question_image' => 'question11651155441.jpeg',
                'answer_image'   => 'answer11651155441.jpeg',
                'answer'         => 'C',
            ],
            [
                'question_id'    => 1,
                'question_image' => 'question21651155441.jpeg',
                'answer_image'   => 'answer21651155441.jpeg',
                'answer'         => 'B',
            ],
            [
                'question_id'    => 1,
                'question_image' => 'question31651155441.jpeg',
                'answer_image'   => 'answer31651155441.jpeg',
                'answer'         => 'D',
            ],
            [
                'question_id'    => 1,
                'question_image' => 'question41651155441.jpeg',
                'answer_image'   => 'answer41651155441.jpeg',
                'answer'         => 'E',
            ]
        ];

        QuestionDetail::insert($questionDetails);
    }
}
