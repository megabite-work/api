<?php

namespace App\Action\MediaObject;

use App\Dto\MediaObject\IndexDto;
use App\Exception\ErrorException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class UploadAction
{
    public const UPLOAD_DIR = 'media';
    public const SIZE = 10485760; // 10 megabayt
    public const EXTENSIONS = ['png', 'jpg', 'jpeg', 'webp', 'pdf', 'xlsx', 'docx', 'doc', 'xls'];

    public function __invoke(UploadedFile $file): IndexDto
    {
        return $this->upload($file);
    }

    public function upload(UploadedFile $file): IndexDto
    {
        $newFilename = uniqid() . '.' . $file->guessExtension();

        try {
            $file->move(static::UPLOAD_DIR, $newFilename);
        } catch (FileException $e) {
            throw new ErrorException('Media Object', 'Failed to upload file: ' . $e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new IndexDto(static::UPLOAD_DIR . '/' . $newFilename);
    }
}
