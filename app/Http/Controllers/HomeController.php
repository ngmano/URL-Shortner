<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShortenerUrl;

class HomeController extends Controller
{        
    public function index($id)
    {
        if($id === null) {
            return redirect('url-sortner/create');
        }
        $model = ShortenerUrl::where(['shortener_url' => $id])->first();
        if($model === null) {            
            return redirect()->to('url-sortner')->with('error', ['Invalid Url']);   
        }
        return redirect()->away($model->original_url);
    }    
}
