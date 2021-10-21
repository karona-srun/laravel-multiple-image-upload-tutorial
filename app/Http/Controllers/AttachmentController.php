<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'images' => 'required',
        ]);

        if ($request->hasfile('images')) {
            $images = $request->file('images');

            foreach($images as $image) {
                $name = $image->getClientOriginalName();
                $path = $image->storeAs('attachments', $name, 'public');

                Attachment::create([
                    'filenames' => $name,
                    'path' => '/storage/'.$path
                  ]);
            }
         }


        return back()->with('success', 'Data Your files has been successfully added');
    }
}
