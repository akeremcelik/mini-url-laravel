<?php

namespace App\Http\Services;

use App\Models\Url;
use Illuminate\Support\Facades\DB;

class UrlService {
    public function createKey() {
        do {
            $key = bin2hex(random_bytes(3));
        } while ($this->findByKey($key));

        return $key;
    }

    public function findByKey($key) {
        return Url::where('key', $key)->firstOrFail();
    }

    public function createUrl($request) {
        return DB::transaction(function() use($request) {
            return Url::create([
                'key' => $this->createKey(),
                'url' => $request["url"]
            ]);
        });
    }
}
