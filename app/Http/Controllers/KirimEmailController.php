<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class KirimEmailController extends Controller
{
    public function kirim()
    {
        $email = 'rpl.zulfikar@gmail.com';
        $data = [
            'title' => 'Selamat datang!',
            'url' => 'https://aantamim.id',
        ];
        Mail::to($email)->send(new SendMail($data));
        return 'Berhasil mengirim email!';
    }
}