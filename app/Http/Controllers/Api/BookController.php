<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Exception;

class BookController extends Controller
{
  /**
   * Get list of books from public/assets/books
   */
  public function index()
  {
    try {
      $directory = public_path('assets/books');

      if (!File::exists($directory)) {
        File::makeDirectory($directory, 0755, true);
      }

      $files = File::files($directory);
      $books = [];

      foreach ($files as $file) {
        if ($file->getExtension() === 'pdf') {
          $filename = $file->getFilename();
          $thumbnailName = str_replace('.pdf', '.png', $filename);
          $thumbnailPath = public_path('assets/books/thumbnails/' . $thumbnailName);

          $books[] = [
            'name'      => $file->getFilenameWithoutExtension(),
            'filename'  => $filename,
            'url'       => asset('assets/books/' . $filename),
            'thumbnail' => File::exists($thumbnailPath) ? asset('assets/books/thumbnails/' . $thumbnailName) : null,
            'size'      => $this->formatBytes($file->getSize()),
            'last_modified' => date("Y-m-d H:i:s", $file->getMTime()),
          ];
        }
      }

      return response()->json([
        'status'  => true,
        'message' => 'Books retrieved successfully',
        'books'   => $books,
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'status'  => false,
        'message' => 'Failed to retrieve books',
        'error'   => $e->getMessage(),
      ], 500);
    }
  }

  /**
   * Get book by its name
   */
  public function show($name)
  {
    try {
      $directory = public_path('assets/books');
      $filename = $name . '.pdf';
      $path = $directory . '/' . $filename;

      if (!File::exists($path)) {
        return response()->json([
          'status'  => false,
          'message' => 'Book not found',
        ], 404);
      }

      $thumbnailName = str_replace('.pdf', '.png', $filename);
      $thumbnailPath = public_path('assets/books/thumbnails/' . $thumbnailName);

      $book = [
        'name'      => $name,
        'filename'  => $filename,
        'url'       => asset('assets/books/' . $filename),
        'thumbnail' => File::exists($thumbnailPath) ? asset('assets/books/thumbnails/' . $thumbnailName) : null,
        'size'      => $this->formatBytes(File::size($path)),
        'last_modified' => date("Y-m-d H:i:s", File::lastModified($path)),
      ];

      return response()->json([
        'status'  => true,
        'message' => 'Book retrieved successfully',
        'book'   => $book,
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'status'  => false,
        'message' => 'Failed to retrieve book',
        'error'   => $e->getMessage(),
      ], 500);
    }
  }

  /**
   * Format bytes to readable size
   */
  private function formatBytes($bytes, $precision = 2)
  {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
  }
}
