<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class FakturPajakController extends Controller
{
    public function extract(Request $request)
    {
        set_time_limit(60);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            if ($extension === 'pdf' || in_array($extension, ['png', 'jpg', 'jpeg'])) {
                $fileName = time() . '.' . $extension;
                $filePath = $file->move(public_path('uploads/faktur-pajak'), $fileName);
                $path = asset('uploads/faktur-pajak/' . $fileName);
                
                $api_key = env('NANO_API',null);
                $modelId = '9f56d072-c917-43a7-bca7-4a3a3bae71d6'; //FakturPajak
                $api_url = 'https://app.nanonets.com/api/v2/OCR/Model/' . $modelId . '/LabelFile/';

                $response = Http::withHeaders([
                    'Accept' => 'multipart/form-data',
                ])
                    ->withBasicAuth($api_key, '')
                    ->attach('file', file_get_contents($filePath), $fileName)
                    ->post($api_url);
        
                $responseData = $response->json();

                $data = $responseData['result'][0]['prediction'] ?? [];

                return view('model.faktur-pajak', ['path' => $path, 'data' => $data]);
                
            } else {
                Alert::error('File type not supported.', 'Please upload an image or a PDF file.');
                // toast('File type not supported. Please upload an image or a PDF file.','error')->position('top-end');
                return back();
            }
        }

        Alert::error('No file uploaded.', 'Please upload an image or a PDF file.');
        // toast('No file uploaded.','error')->position('top-end');
        return back();
    }
}
