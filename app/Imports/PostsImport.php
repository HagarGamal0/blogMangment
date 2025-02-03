<?php

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Post([
            'title' => $row['title'],
            'content' => $row['content'],
            'slug' => $row['slug'],
            'blog_image' => $row['blog_image'],
            'user_id' => $row['author_id'],
        ]);
    }
}
