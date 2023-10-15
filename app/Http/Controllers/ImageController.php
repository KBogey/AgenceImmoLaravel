<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use League\Glide\Signatures\SignatureFactory;


class ImageController extends Controller
{
    public function show(Request $request, string $path)
    {
        SignatureFactory::create(config('glide.key'))->validateRequest($request->path(), $request->all());
        $server = ServerFactory::create([
            'base_url' => 'images',
            'response' => new LaravelResponseFactory($request),
            'source' => Storage::disk('public')->getDriver(),
            'cache' => Storage::disk('local')->getDriver(),
            'cache_path_prefix' => '.cache'
        ]);
        return $server->getImageResponse($path, $request->all());
    }
}
