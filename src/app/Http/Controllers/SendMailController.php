<?php

namespace App\Http\Controllers;

use App\Mail\HtmlMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendMailController extends Controller
{
    public function __invoke(Request $request)
    {
        Log::info(__METHOD__, ['request' => $request->all()]);
        $data = $request->validate([
            'to_address' => 'required|email',
            'title' => 'required|string',
            'body_email' => 'required|string',
        ]);

        Mail::to($data['to_address'])->send(new HtmlMail($data['body_email'], $data['title']));

        return response()->json(['message' => 'Email sent successfully'], 200);
    }
}