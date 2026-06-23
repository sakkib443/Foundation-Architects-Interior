<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Stores uploaded images directly under public/images/uploads/{folder} and
 * returns the relative path (e.g. "images/uploads/projects/ab12-photo.jpg")
 * suitable for asset(). Avoids storage:link (Windows-friendly).
 */
trait HandlesUploads
{
    protected function storeUpload(Request $request, string $field, string $folder): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        return $this->moveFile($request->file($field), $folder);
    }

    /** @return string[] relative paths of all uploaded files for $field */
    protected function storeUploads(Request $request, string $field, string $folder): array
    {
        $paths = [];
        foreach ((array) $request->file($field, []) as $file) {
            if ($file) {
                $paths[] = $this->moveFile($file, $folder);
            }
        }

        return $paths;
    }

    private function moveFile($file, string $folder): string
    {
        $clean = preg_replace('/[^A-Za-z0-9._-]/', '', $file->getClientOriginalName() ?: 'image.jpg');
        $name = Str::random(8).'-'.$clean;
        $dir = public_path('images/uploads/'.$folder);

        if (! is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }

        $file->move($dir, $name);

        return 'images/uploads/'.$folder.'/'.$name;
    }
}
