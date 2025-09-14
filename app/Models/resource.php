<?php

namespace App\Models;
use Illuminate\Support\Arr;

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

public static function find (int $id): array
{
    $resource = Arr::first(static::all(), fn($resource) => $resource['id'] == $id);
    if(!$resource) {
        abort(404);
    }
    return $resource;
}
}