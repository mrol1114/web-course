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
        $file = $request->files->get($key) ?? null;
        if ($file && $file->getError() === 0 && $file->getClientMimeType() === self::MIME_FILE_TYPE && $file->getMaxFilesize() < self::FILE_SIZE)
        {
            if (!is_dir(self::BASE . '/' . $email))
            {
                mkdir(self::BASE . '/' . $email, 0777, true);
            }
            $imageId = $this->generateId();
            $toPath = $this->createImageLink($imageId, $email);
            move_uploaded_file($file->getPathName(), $toPath);
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