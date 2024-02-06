<?php

namespace App\Http\Controllers;

use App\Models\RemoteUrl;
use App\Models\Tenants;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

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
                'system' => Tenants::where('domain', Str::of($url->url)->afterLast('//'))->first()->id,
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
