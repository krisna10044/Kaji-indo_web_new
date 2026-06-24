<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('pages.home', [
            'title' => 'Beranda',
            'metaDescription' => 'KAJI Indonesia - Membangun Indonesia melalui kajian, pelatihan, pendampingan UMKM, Halal Center, dan konsultasi profesional.',
        ]);
    }
}
