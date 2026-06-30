<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StorageController extends Controller
{
    /**
     * Serve files from the "public" disk (storage/app/public).
     *
     * Acts as a fallback for shared hosting where the public/storage
     * symlink can't be created (symlink() disabled or not followed by
     * Apache). When the symlink works, Apache serves the file directly
     * and this route is never reached.
     */
    public function __invoke(string $path): BinaryFileResponse
    {
        // Reject path traversal attempts outright.
        abort_if(str_contains($path, '..'), 404);

        abort_unless(Storage::disk('public')->exists($path), 404);

        return response()->file(
            Storage::disk('public')->path($path),
            ['Cache-Control' => 'public, max-age=31536000']
        );
    }
}
