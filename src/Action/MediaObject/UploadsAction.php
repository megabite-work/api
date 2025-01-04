<?php

namespace App\Action\MediaObject;

use App\Exception\ErrorException;
use Symfony\Component\HttpFoundation\Response;

class UploadsAction
{
    public function __construct(
        private UploadAction $action
    ) {}

    public function __invoke(array $files): array
    {
        $files = $this->validate($files);

        return array_map(fn($file) => $this->action->upload($file), $files);
    }

    private function validate(array $files): array
    {
        $files = array_slice($files, 0, 6);

        foreach ($files as $file) {
            $ext = $file->guessExtension();
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();

            if (!in_array($ext, $this->action::EXTENSIONS)) {
                throw new ErrorException('Media Object', "Failed file extension on: $fileName", Response::HTTP_BAD_REQUEST);
            }
            if ($fileSize > $this->action::SIZE) {
                throw new ErrorException('Media Object', "Failed file size on: $fileName", Response::HTTP_BAD_REQUEST);
            }
        }

        return $files;
    }
}
