<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index() {
        return Post::latest()->orderBy('created_at')->get();
    }

    public function show($id)
    {
        return Post::findOrFail($id);
    }

    public function store(Request $request)
    {
        $filenameWithExt = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        $request->file('file')->storeAs('public/images', $filenameToStore);
        return Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'image' => asset('storage/images/'.$filenameToStore),
        ]);
    }

    public function update(Request $request, $id)
    {
        Post::findOrFail($id)->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);
    }

    public function delete($id)
    {
        $filePath = Post::find($id)->image;
        $fileName = str_replace("http://127.0.0.1:8000/storage/images/", "", $filePath);
        Storage::delete('public/images/'.$fileName);
        return Post::destroy($id);
    }
}
