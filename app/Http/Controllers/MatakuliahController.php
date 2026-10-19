<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): view
    {
        $kolom = [
            'kode' => 'Kode', 'nama' => 'Mata Kuliah',
            'sks' => 'SKS', 'semester' => 'Semester',
            'jenis' => 'Jenis',
        ];

        $matakuliah = [
            ['kode' => 'TIF201', 'nama' => 'Pemrograman Web',
            'sks' => 3, 'semester' => 3, 'jenis' => 'Praktik'],
            ['kode' => 'TIF202', 'nama' => 'Basis Data',
            'sks' => 3, 'semester' => 2, 'jenis' => 'Praktik'],
            ['kode' => 'TIF301', 'nama' => 'Rekayasa Perangkat Lunak',
            'sks' => 3, 'semester' => 4, 'jenis' => 'Teori'],
            ['kode' => 'TIF203', 'nama' => 'Jaringan Komputer',
            'sks' => 2, 'semester' => 3, 'jenis' => 'Teori'],
        ];

        return view('matakuliah.index', compact('kolom', 'matakuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
