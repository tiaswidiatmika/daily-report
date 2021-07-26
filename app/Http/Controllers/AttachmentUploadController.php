<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use Illuminate\Support\Str;
// use App\Http\Requests\StoreAttachmentRequest as ValidateAttachment;

class AttachmentUploadController extends Controller
{
    public static function store (Request $request, $postId)
    {
    // protected $fillable = ['title','post_id', 'category', 'path'];
        if ( $request->image == null ) {
            return;
        }
        $request->validate([
            'image.*' => 'mimes:jpg,jpeg,png,bmp'
        ]);
        
        // creating new image name to avoid same name for every images uploaded for every files
        // new image moved to public directory, create the "attachments" folder before implementing this following code
        $attachmentTitle = $request->input('attachment_title');
        $attachmentTitle = $attachmentTitle ?? 'Lampiran Pemeriksan';
        $files = $request->file('image');
        if($files !== []) {
            foreach($files as $file) {
                $imageName = 'Riksa 4 Daily Report - ' . Str::random(12) . time() . 'report-id-' . $postId . '.' . $file->extension();
                $file->move(public_path('attachments'), $imageName);
                Attachment::create([
                    'title' => $attachmentTitle,
                    'image_name' => $imageName,
                    'post_id' => $postId,
                    'path' => $imageName
                ]);
            }

        }
    }

}
