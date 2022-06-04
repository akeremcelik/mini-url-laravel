<?php

namespace App\Http\Services;

use App\Models\Url;
use Illuminate\Support\Facades\DB;

class UrlService {
    public function createKey() {
        do {
            $key = bin2hex(random_bytes(3));
        } while ($this->findByKeyWithoutFail($key));

        return $key;
    }

    public function findByKey($key) {
        return Url::where('key', $key)->firstOrFail();
    }

    public function findByKeyWithoutFail($key) {
        return Url::where('key', $key)->first();
    }

    public function createUrl($request) {
        $this->sendRequestToUrl($request["url"]);
        return DB::transaction(function() use($request) {
            return Url::create([
                'key' => $this->createKey(),
                'url' => $request["url"]
            ]);
        });
    }

    public function sendRequestToUrl($url) {
        try {
            file_get_contents($url);
        } catch (\Exception $e) {
            throw new \ErrorException('Host not found connected to the URL');
        }
    }
}
