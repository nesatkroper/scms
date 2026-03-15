<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AutoUploadAvatarCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-upload-avatar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto upload and crop avatars for users with null avatar from public/person';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sourceDir = public_path('person');
        $targetDir = public_path('uploads/avatars');

        if (!\Illuminate\Support\Facades\File::exists($targetDir)) {
            \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true);
        }

        $files = \Illuminate\Support\Facades\File::files($sourceDir);
        
        // Filter for images only
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $files = array_values(array_filter($files, function ($file) use ($imageExtensions) {
            return in_array(strtolower($file->getExtension()), $imageExtensions);
        }));

        if (empty($files)) {
            $this->error('No images found in public/person');
            return;
        }

        $users = \App\Models\User::whereNull('avatar')->get();
        if ($users->isEmpty()) {
            $this->info('No users found with null avatar');
            return;
        }

        $this->info("Processing {$users->count()} users...");

        $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());

        foreach ($users as $index => $user) {
            // Pick an image - sequentially if possible, otherwise wrap around
            $file = $files[$index % count($files)];
            
            $filename = 'avatar_' . $user->id . '_' . time() . '.jpg';
            $targetPath = $targetDir . '/' . $filename;

            try {
                $image = $manager->read($file->getPathname());
                
                // Crop to square 1:1 and maybe resize to a reasonable size like 400x400
                // User said "crop to square (1x1)", cover(size, size) handles cropping to center
                $width = $image->width();
                $height = $image->height();
                $size = min($width, $height, 500);
                
                $image->cover($size, $size);
                $image->save($targetPath);

                $user->avatar = 'uploads/avatars/' . $filename;
                $user->save();

                $this->info("Uploaded avatar for User ID: {$user->id} using {$file->getFilename()}");
            } catch (\Exception $e) {
                $this->error("Failed to process image for User ID: {$user->id}. Error: {$e->getMessage()}");
            }
        }

        $this->info('Auto upload completed!');
    }
}
