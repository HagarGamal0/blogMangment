<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PostsImport;
use App\Exports\PostsExport;
use App\Models\Post;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            $posts = Post::all();
        } else {
            $posts = Post::where('user_id', auth()->id())->get();
        }
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:posts',
            'content' => 'required',
            'slug' => 'required|unique:posts',
            'blog_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('blog_image')) {
            $data['blog_image'] = $request->file('blog_image')->store('uploads');
        }
        $data['user_id'] = auth()->id();

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Post Created');
    }


    public function export()
  {
    return Excel::download(new PostsExport, 'posts.xlsx');
  }

 public function import(Request $request)
  {
    $request->validate([
        'file' => 'required|mimes:xlsx,csv',
    ]);

    Excel::import(new PostsImport, $request->file('file'));

    return redirect()->back()->with('success', 'Posts Imported');
 }
}
