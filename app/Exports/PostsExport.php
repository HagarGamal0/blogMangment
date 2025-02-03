<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;

class PostsExport implements FromCollection
{
    public function collection()
    {
        return auth()->user()->hasRole('Admin')
            ? Post::all()
            : Post::where('user_id', auth()->id())->get();
    }
}
