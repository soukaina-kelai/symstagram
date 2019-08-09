<?php
/**
 * Created by PhpStorm.
 * User: tomsihap
 * Date: 2019-08-09
 * Time: 12:14
 */

namespace App\Services;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploadService
{

    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function uploadFile(UploadedFile $uploadedFile) {

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        // this is needed to safely include the file name as part of the URL
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

        // Move the file to the directory where brochures are stored
        try {
            $uploadedFile->move(
                $this->targetDirectory,
                $newFilename
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        // updates the 'brochureFilename' property to store the PDF file name
        // instead of its contents
        return $newFilename;
    }
}