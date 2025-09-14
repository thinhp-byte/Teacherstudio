<?php

namespace App\Models;

class resource {
    public static function all(): array
{
    return $resources =[
            [
                'id' => 1,
                'title'=> 'mid term exam',
                'subject' => 'math',
                'grade' => '10',
            ],
            [
                'id' => 2,
                'title'=> 'final exam',
                'subject' => 'biology',
                'grade' => '11',
            ],
            [
                'id' => 3,
                'title'=> 'quiz 1',
                'subject' => 'chemistry',
                'grade' => '12',
            ]
            ];
}
}