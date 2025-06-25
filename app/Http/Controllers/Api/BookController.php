<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('issues')->paginate(10);
        return BookResource::collection($books);
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        $book = Book::create($data);
        $book->load('issues');
        return new BookResource($book);
    }

    public function show(Book $book)
    {
        $book->load('issues');
        return new BookResource($book);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        $book->update($data);
        $book->load('issues');
        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully'], 204);
    }
}
