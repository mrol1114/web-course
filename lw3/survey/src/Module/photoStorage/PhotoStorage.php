<?php

namespace App\Module\photoStorage;

use Symfony\Component\HttpFoundation\Request;

class PhotoStorage
{
    private const BASE = 'data';
    private const FILE_SIZE = 10 * 1024 * 1024;
    private const MIME_FILE_TYPE = 'image/png';
    private const FILE_TYPE = '.png';

    public function saveImg(Request $request, string $key, string $email): string
    {
        $file = $_FILES[$key] ?? null;
        if ($file && $file['error'] === 0 && $file['size'] < self::FILE_SIZE && $file['type'] === self::MIME_FILE_TYPE)
        {
            if (!is_dir(self::BASE . '/' . $email))
            {
                mkdir(self::BASE . '/' . $email, 0777, true);
            }
            $imageId = $this->generateId();
            $toPath = $this->createImageLink($imageId, $email);
            move_uploaded_file($file['tmp_name'], $toPath);
            return $imageId;
        }
        return '';
    }

    public function createImageLink(string $imageId, string $email): string
    {
        return self::BASE . '/' . $email . '/' . $imageId . self::FILE_TYPE;
    }

    private function generateId() : string
    {
        return uniqid('', true);
    }
}