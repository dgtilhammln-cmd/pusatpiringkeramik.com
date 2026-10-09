<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageOptimizer
{
    /**
     * Optimize an uploaded image file and save as WebP with optional max width.
     * Returns the relative storage path (e.g. "articles/xyz.webp").
     */
    public static function optimizeUpload(UploadedFile $file, string $folder = 'uploads', int $maxWidth = 1920, int $quality = 82): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $cleanName = preg_replace('/[^a-zA-Z0-9_\-]/', '', $filename);
        if (!$cleanName) {
            $cleanName = 'img_' . time();
        }
        $targetName = $folder . '/' . $cleanName . '_' . time() . '_' . uniqid() . '.webp';

        $realPath = $file->getRealPath();

        // Attempt WebP conversion using GD or Intervention
        $imageResource = null;
        if (in_array($extension, ['jpg', 'jpeg'])) {
            $imageResource = @imagecreatefromjpeg($realPath);
        } elseif ($extension === 'png') {
            $imageResource = @imagecreatefrompng($realPath);
            if ($imageResource) {
                imagealphablending($imageResource, true);
                imagesavealpha($imageResource, true);
            }
        } elseif ($extension === 'webp') {
            $imageResource = @imagecreatefromwebp($realPath);
        } elseif ($extension === 'gif') {
            $imageResource = @imagecreatefromgif($realPath);
        }

        if ($imageResource) {
            $width = imagesx($imageResource);
            $height = imagesy($imageResource);

            // Resize if exceeds max width
            if ($width > $maxWidth) {
                $newWidth = $maxWidth;
                $newHeight = (int) round(($height / $width) * $newWidth);
                $resized = imagecreatetruecolor($newWidth, $newHeight);

                if (in_array($extension, ['png', 'webp'])) {
                    imagealphablending($resized, false);
                    imagesavealpha($resized, true);
                    $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
                    imagefilledrectangle($resized, 0, 0, $newWidth, $newHeight, $transparent);
                }

                imagecopyresampled($resized, $imageResource, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagedestroy($imageResource);
                $imageResource = $resized;
            }

            // Save to temp file as WebP
            $tempPath = sys_get_temp_dir() . '/' . uniqid('webp_') . '.webp';
            imagewebp($imageResource, $tempPath, $quality);
            imagedestroy($imageResource);

            if (file_exists($tempPath)) {
                Storage::disk('public')->put($targetName, file_get_contents($tempPath));
                @unlink($tempPath);
                return $targetName;
            }
        }

        // Fallback: standard Laravel storage if GD fails
        return $file->store($folder, 'public');
    }

    /**
     * Convert an existing file on public disk to WebP if not already converted.
     */
    public static function convertExistingToWebp(string $relativePath, int $quality = 82): ?string
    {
        if (str_ends_with(strtolower($relativePath), '.webp')) {
            return $relativePath;
        }

        $fullPath = Storage::disk('public')->path($relativePath);
        if (!file_exists($fullPath)) {
            return null;
        }

        $pathInfo = pathinfo($relativePath);
        $webpRelative = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
        $webpFullPath = Storage::disk('public')->path($webpRelative);

        if (file_exists($webpFullPath)) {
            return $webpRelative;
        }

        $ext = strtolower($pathInfo['extension'] ?? '');
        $img = null;
        if (in_array($ext, ['jpg', 'jpeg'])) {
            $img = @imagecreatefromjpeg($fullPath);
        } elseif ($ext === 'png') {
            $img = @imagecreatefrompng($fullPath);
            if ($img) {
                imagealphablending($img, true);
                imagesavealpha($img, true);
            }
        }

        if ($img) {
            imagewebp($img, $webpFullPath, $quality);
            imagedestroy($img);
            if (file_exists($webpFullPath)) {
                return $webpRelative;
            }
        }

        return null;
    }
}
