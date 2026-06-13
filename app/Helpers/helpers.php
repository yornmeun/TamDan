<?php
use App\Models\User;

if (!function_exists('generateNumber')) {
    function generateNumber(string $prefix, User $user, string $model): string {
        $generateModelRecords = $user->{$model}()->get();
        $numberOfRecords = $generateModelRecords->count();

        if ($numberOfRecords === 0) {
            return $prefix . '_000001';
        }
        
        return $prefix . '_' . str_pad($numberOfRecords + 1, 6, '0', STR_PAD_LEFT);
    }
}