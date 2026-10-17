<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;

class BukuController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return Inertia::render('Buku', [
            'books' => $books,
        ]);
    }
}
