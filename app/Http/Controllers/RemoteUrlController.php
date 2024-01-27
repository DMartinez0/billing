<?php

namespace App\Http\Controllers;

use App\Http\Resources\RemoteUrlResource;
use App\Models\RemoteUrl;
use Illuminate\Http\Request;

class RemoteUrlController extends Controller
{
    /**
     * Obtiene la url que corresponde al email
     * 
     */
    public function index(Request $request){
        $url = RemoteUrl::where('email', $request->email)->first();
        if ($url) {
            return RemoteUrlResource::make($url);
        }
        return errorResponse();
    }


    /**
     * Guarda el email y la url del nuevo usuario
     */
    public function store(Request $request)
    {
        return successResponse($request->all());
    }

}
