<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UrlRequest;
use App\Http\Resources\Api\UrlResource;
use App\Http\Services\UrlService;

class UrlController extends Controller
{
    public function show($key, UrlService $urlService) {
        $url = $urlService->findByKey($key);
        return UrlResource::make($url);
    }

    public function store(UrlRequest $request, UrlService $urlService) {
        $url = $urlService->createUrl($request->validated());
        return UrlResource::make($url);
    }
}
