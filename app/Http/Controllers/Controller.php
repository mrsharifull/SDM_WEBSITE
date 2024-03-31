<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function statusChange($modelData)
    {
        if($modelData->status == 1){
            $modelData->status = 0;
        }else{
            $modelData->status = 1;
        }
        $modelData->save();
    }
    public function fileDelete($image)
        {
            if ($image) {
                Storage::delete('public/' . $image);
            }
        }
    public function view_or_download($file_url){
            $file_url = base64_decode($file_url);
            dd($file_url);
            if (Storage::exists('public/' . $file_url)) {
                $fileExtension = pathinfo($file_url, PATHINFO_EXTENSION);

                if (strtolower($fileExtension) === 'pdf') {
                    return response()->file(storage_path('app/public/' . $file_url), [
                        'Content-Disposition' => 'inline; filename="' . basename($file_url) . '"'
                    ]);
                } else {
                    return response()->download(storage_path('app/public/' . $file_url), basename($file_url));
                }
            } else {
                return response()->json(['error' => 'File not found'], 404);
            }
        }
}
