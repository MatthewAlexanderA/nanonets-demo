<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class BankStatementController extends Controller
{
    public function extract(Request $request)
    {
        set_time_limit(60);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            if ($extension === 'pdf' || in_array($extension, ['png', 'jpg', 'jpeg'])) {
                $fileName = time() . '.' . $extension;
                $filePath = $file->move(public_path('uploads/bank-statement'), $fileName);
                $path = asset('uploads/bank-statement/' . $fileName);
                
                $api_key = env('NANO_API',null);
                $modelId = 'daf4a536-c28a-4f3d-b47a-7c956b30ed47'; //BankStatement
                $api_url = 'https://app.nanonets.com/api/v2/OCR/Model/' . $modelId . '/LabelFile/';

                $response = Http::withHeaders([
                    'Accept' => 'multipart/form-data',
                ])
                    ->withBasicAuth($api_key, '')
                    ->attach('file', file_get_contents($filePath), $fileName)
                    ->post($api_url);
        
                $responseData = $response->json();

                $data = $responseData['result'][0]['prediction'] ?? [];

                return view('model.bank-statement', ['path' => $path, 'data' => $data]);
                
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
