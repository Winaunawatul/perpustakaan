<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BukuController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $books = Book::all();

        return Inertia::render('Buku', [
            'books' => $books,
        ]);
    }

    // Menampilkan formulir tambah buku
    public function create()
    {
        return Inertia::render('BukuCreate');
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|string|max:50|unique:books,kode_buku',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun' => 'nullable|digits:4',
            'stok' => 'required|integer|min:0',
        ]);

        Book::create($validated);

        return redirect()
            ->route('buku')
            ->with('success', 'Buku berhasil ditambahkan.');
    }
}
