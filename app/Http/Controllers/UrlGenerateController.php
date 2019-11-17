<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShortenerUrl;

class UrlGenerateController extends Controller
{
    public $rules = [
        'original_url' => 'required|url',        
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('url-sortner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $request->validate($this->rules);
        $model = new ShortenerUrl();
        $model = $model->fill($request->all());
        $model->save();
        $model->shortener_url = url($model->shortener_url);
        
        $this->setMessage('URL Sorted successfully..!');
        return $this->sendResponse($model);
    }    
}
