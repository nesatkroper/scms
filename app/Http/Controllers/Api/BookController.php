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
        return response()->json([
          'status'  => false,
          'message' => 'Books directory not found',
          'books'   => [],
        ], 404);
      }

      $files = File::files($directory);
      $books = [];

      foreach ($files as $file) {
        // Only include common document formats if needed, or all files
        // For now, including all files in that directory
        $filename = $file->getFilename();
        $thumbnailName = str_replace('.pdf', '.png', $filename);
        $thumbnailPath = public_path('assets/books/thumbnails/' . $thumbnailName);

        $books[] = [
          'name'      => $file->getFilenameWithoutExtension(),
          'filename'  => $filename,
          'url'       => asset('assets/books/' . $filename),
          'thumbnail' => File::exists($thumbnailPath) ? asset('assets/books/thumbnails/' . $thumbnailName) : null,
          'size'      => $this->formatBytes($file->getSize()),
          'extension' => $file->getExtension(),
          'last_modified' => date("Y-m-d H:i:s", $file->getMTime()),
        ];
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
