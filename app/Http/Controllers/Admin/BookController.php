<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class BookController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    // Assuming 'Manage Books' or similar permission might be needed, 
    // but since we are mirroring the structure, I'll keep it simple.
    // If applyPermissions() requires a model name, we might need to handle it.
  }

  protected function ModelPermissionName(): string
  {
    return 'Course'; // Reusing Course permission or similar if specific Book permission doesn't exist
  }

  public function index()
  {
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

        // Generate thumbnail if it doesn't exist
        if (!File::exists($thumbnailPath)) {
          $this->generateThumbnail($file->getRealPath(), $thumbnailPath);
        }

        $books[] = [
          'name' => $file->getFilenameWithoutExtension(),
          'filename' => $filename,
          'url' => asset('assets/books/' . $filename),
          'thumbnail' => File::exists($thumbnailPath) ? asset('assets/books/thumbnails/' . $thumbnailName) : null,
          'size' => $this->formatBytes($file->getSize()),
          'last_modified' => date("Y-m-d H:i:s", $file->getMTime()),
        ];
      }
    }

    return view('admin.books.index', compact('books'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'books' => 'required|array',
      'books.*' => 'file|mimes:pdf|max:51200', // 50MB max per file
    ]);

    $successCount = 0;
    $errors = [];

    try {
      $path = public_path('assets/books');
      if (!File::exists($path)) {
        File::makeDirectory($path, 0755, true);
      }

      foreach ($request->file('books') as $file) {
        try {
          $filename = $file->getClientOriginalName();

          // Check if file already exists to avoid overwriting or handle as needed
          // For now, allow overwrite or append timestamp if preferred. 
          // Sticking to original name as requested for simple directory management.

          $file->move($path, $filename);

          // Generate thumbnail
          $thumbnailName = str_replace('.pdf', '.png', $filename);
          $thumbnailPath = public_path('assets/books/thumbnails/' . $thumbnailName);
          $this->generateThumbnail($path . '/' . $filename, $thumbnailPath);

          $successCount++;
        } catch (\Exception $fe) {
          $errors[] = "Failed to upload {$file->getClientOriginalName()}: " . $fe->getMessage();
        }
      }

      $message = "Successfully uploaded $successCount book(s).";
      if (!empty($errors)) {
        return redirect()->route('admin.books.index')->with('success', $message)->with('error', implode('<br>', $errors));
      }

      return redirect()->route('admin.books.index')->with('success', $message);
    } catch (\Exception $e) {
      Log::error('Error uploading books: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Failed to process upload: ' . $e->getMessage());
    }
  }

  public function destroy($filename)
  {
    try {
      $bookPath = public_path('assets/books/' . $filename);
      $thumbnailPath = public_path('assets/books/thumbnails/' . str_replace('.pdf', '.png', $filename));

      if (File::exists($bookPath)) {
        File::delete($bookPath);
      }

      if (File::exists($thumbnailPath)) {
        File::delete($thumbnailPath);
      }

      return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    } catch (\Exception $e) {
      Log::error('Error deleting book: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Failed to delete book.');
    }
  }

  private function generateThumbnail($pdfPath, $thumbnailPath)
  {
    try {
      $outputPrefix = str_replace('.png', '', $thumbnailPath);

      // Using pdftoppm which we verified is available
      // -f 1 (first page) -l 1 (last page = 1) -png (output format) -singlefile (don't add -1 suffix)
      $command = "pdftoppm -f 1 -l 1 -png -singlefile " . escapeshellarg($pdfPath) . " " . escapeshellarg($outputPrefix);

      exec($command, $output, $returnVar);

      if ($returnVar !== 0) {
        Log::warning("Failed to generate thumbnail for {$pdfPath}. Return code: {$returnVar}");
      }
    } catch (\Exception $e) {
      Log::error("Thumbnail generation error: " . $e->getMessage());
    }
  }

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
