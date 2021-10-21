<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return view('index',compact('posts'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        // redirects to 'AnotherController@show'
        return redirect()->action([PostController::class, 'show'], $post->id);
    }

    public function uploadAttachment(Request $request)
    {
        $this->validate($request, [
            'uploadFile' => 'required',
        ]);

        if ($request->hasfile('uploadFile')) {
            $images = $request->file('uploadFile');

            foreach($images as $image) {
                $name = $image->getClientOriginalName();
                $rename = time() .'_'. preg_replace('/[^A-Za-z0-9\-\(\).]/', '', $name);
                $path = $image->storeAs('attachments', $rename, 'public');

                $att = Attachment::create([
                    'post_id' => $request->post_id,
                    'filenames' => $rename,
                    'path' => '/storage/'.$path
                  ]);
            }
        }

        // return response()->json([
        //     'success' => 'Attachment uploaded successfully!',
        //     'data' => $att
        // ]);
        return redirect()->action([PostController::class, 'show'], $request->post_id);
    }

    public function deleteAttachment($id)
    {
        $attachment = Attachment::find($id);
        if($attachment->delete()){
            File::delete(public_path('storage/attachments/'.$attachment->filenames));
        }
        return response()->json([
            'success' => 'Attachment deleted successfully!'
        ]);
    
    }

    public function show($id){
        $post = Post::find($id);
        return view('show',compact('post'));
    }
}
