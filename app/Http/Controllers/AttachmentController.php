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
        // $imageName = request()->file->getClientOriginalName();
        // request()->file->move(public_path('uploads'), $imageName);

        // Attachment::create([
        //     'post_id' => '1',
        //     'filenames' => $imageName,
        //     'path' => '/storage/'.$imageName
        // ]);
    	// return response()->json(['uploaded' => '/uploads/'.$imageName]);

        $preview = $config = $errors = [];
        $input = 'kartik-input-705'; // the input name for the fileinput plugin
        if (empty($_FILES[$input])) {
            return [];
        }
        $total = count($_FILES[$input]['name']); // multiple files
        $path = 'uploads/'; // your upload path
        for ($i = 0; $i < $total; $i++) {
            $tmpFilePath = $_FILES[$input]['tmp_name'][$i]; // the temp file path
            $fileName = $_FILES[$input]['name'][$i]; // the file name
            $fileSize = $_FILES[$input]['size'][$i]; // the file size
            
            //Make sure we have a file path
            if ($tmpFilePath != ""){
                //Setup our new file path
                $newFilePath = $path. $fileName;
                $newFileUrl = '/uploads/' . $fileName;
                
                //Upload the file into the new path
                if(move_uploaded_file($_FILES[$input]['tmp_name'][$i], $newFilePath)) {
                    $fileId = $fileName . $i; // some unique key to identify the file
                    $preview[] = $newFileUrl;
                    $config[] = [
                        'key' => $fileId,
                        'caption' => $fileName,
                        'size' => $fileSize,
                        'downloadUrl' => $newFileUrl, // the url to download the file
                        'url' => '/file-delete', // server api to delete the file based on key
                    ];
                } else {
                    $errors[] = $fileName;
                }
            } else {
                $errors[] = $fileName;
            }
        }
        $out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true];
        if (!empty($errors)) {
            $img = count($errors) === 1 ? 'file "' . $errors[0]  . '" ' : 'files: "' . implode('", "', $errors) . '" ';
            $out['error'] = 'Oh snap! We could not upload the ' . $img . 'now. Please try again later.';
        }
        return $out;
    }

    public function delete($request)
    {
        dd($request);
        Attachment::find($request->id)->delete($request->id);
  
        return response()->json([
            'success' => 'Attachment deleted successfully!'
        ]);
    }
}
