<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;
use App\Jobs\SendContactMailJob;

class ContactController extends Controller
{
    public function sendMail(ContactRequest $request) {
        SendContactMailJob::dispatch($request->validated());
    }
}
