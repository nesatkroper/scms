<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class StudentObserver
{
    /**
     * Clear student-related cache
     */
    private function clearStudentCache(User $user): void
    {
        if (!$user->hasRole('student')) {
            return;
        }

        // Clear specific student caches
        $patterns = [
            "student_{$user->id}_fees_page_*",
            "student_{$user->id}_enrollments_page_*",
            "student_{$user->id}_show_*",
        ];

        foreach ($patterns as $pattern) {
            // Note: This is a simple implementation
            // For production with Redis, use Cache::tags() or scan for keys
            Cache::forget($pattern);
        }

        // Clear index cache (affects all users who can see this student)
        // This is a broad clear, but ensures consistency
        Cache::flush(); // In production, use more targeted clearing with tags
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->clearStudentCache($user);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $this->clearStudentCache($user);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->clearStudentCache($user);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        $this->clearStudentCache($user);
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        $this->clearStudentCache($user);
    }
}
