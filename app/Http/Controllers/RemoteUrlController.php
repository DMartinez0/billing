<?php

namespace App\Http\Controllers;

use App\Http\Resources\RemoteUrlResource;
use App\Models\RemoteUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RemoteUrlController extends Controller
{
    /**
     * Obtiene la url que corresponde al email
     * 
     */
    public function oauth(Request $request){
        $url = RemoteUrl::where('email', $request->email)->first();
        if ($url) {
            return response()->json([
                'url' => $url->url, 
                'id' => $url->client_id, 
                'hash' => $url->client_secret, 
            ], 200);
        }

        return errorResponse("Usuario o contraseña incorrecta");
    }


    /**
     * Guarda el email y la url del nuevo usuario
     */
    public function store(Request $request)
    {
        return successResponse($request->all());
    }

}
