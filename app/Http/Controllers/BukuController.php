<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BukuController extends Controller
{
    // Menampilkan daftar buku dan melakukan pencarian
    public function index(Request $request)
    {
        $search = $request->input('search');

        $books = Book::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('pengarang', 'like', "%{$search}%")
                      ->orWhere('kode_buku', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return Inertia::render('Buku', [
            'books' => $books,
            'filters' => [
                'search' => $search,
            ],
            'flash' => [
                'success' => session('success'),
            ],
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

    // Menampilkan formulir edit buku
    public function edit(Book $book)
    {
        return Inertia::render('BukuEdit', [
            'book' => $book,
        ]);
    }

    // Menyimpan perubahan buku
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|string|max:50|unique:books,kode_buku,' . $book->id,
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun' => 'nullable|digits:4',
            'stok' => 'required|integer|min:0',
        ]);

        $book->update($validated);

        return redirect()
            ->route('buku')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()
            ->route('buku')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
