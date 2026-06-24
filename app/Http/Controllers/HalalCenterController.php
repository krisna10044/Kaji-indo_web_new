<?php

namespace App\Http\Controllers;

use App\Models\Trainer; 
use Illuminate\View\View;

class HalalCenterController extends Controller
{
    public function index(): View
    {
        return view('pages.halal-center', [
            'title' => 'Halal Center',
            'metaDescription' => 'Layanan Halal Center resmi untuk sertifikasi halal, konsultasi, dan pendampingan usaha.',
        ]);
    }

    public function gratis(): View
    {
        $p3hTrainers = Trainer::approved()   
            ->halal()
            ->whereNotNull('academic_degree')       
        ->where('academic_degree', '!=', '')
            ->orderBy('full_name')
            ->get();

        return view('pages.halal-center-gratis', [
            'title'           => 'Layanan Gratis Halal Center',
            'metaDescription' => 'Layanan gratis Halal Center untuk pendampingan sertifikasi halal dan edukasi masyarakat.',
            'p3hTrainers'     => $p3hTrainers,   // ← tambah ini
        ]);
    }
    public function berbayar(): View
    {
        return view('pages.halal-center-berbayar', [
            'title' => 'Layanan Berbayar Halal Center',
            'metaDescription' => 'Layanan berbayar Halal Center dengan konsultasi mendalam dan pendampingan premium.',
        ]);
    }

    public function create(): View
    {
        return view('pages.halalcentercreate', [
            'title' => 'Tambah Data Halal Center',
            'metaDescription' => 'Form untuk menambahkan data baru ke sistem Halal Center.',
        ]);
    }

    public function show(string $id): View
    {
        return view('pages.halalcentershow', [
            'title' => 'Detail Halal Center',
            'metaDescription' => 'Detail informasi Halal Center.',
            'id' => $id,
        ]);
    }

    public function edit(string $id): View
    {
        return view('pages.halalcenteredit', [
            'title' => 'Edit Data Halal Center',
            'metaDescription' => 'Form untuk mengedit data Halal Center.',
            'id' => $id,
        ]);
    }
}