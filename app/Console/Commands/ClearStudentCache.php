<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearStudentCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-students {student_id? : Optional student ID to clear specific cache}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear student-related cache entries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $studentId = $this->argument('student_id');

        if ($studentId) {
            // Clear cache for specific student
            $patterns = [
                "student_{$studentId}_*",
            ];
            
            foreach ($patterns as $pattern) {
                Cache::forget($pattern);
            }
            
            $this->info("Cache cleared for student ID: {$studentId}");
        } else {
            // Clear all student-related caches
            Cache::flush();
            $this->info('All student caches cleared successfully!');
        }

        return 0;
    }
}
