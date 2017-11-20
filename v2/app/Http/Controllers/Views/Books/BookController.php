<?php

namespace App\Http\Controllers\Views\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller {        
    
    public function get(Request $request, $book_id) {        
        return view('books.book')->with(['book_id' => $book_id]);
    }
}