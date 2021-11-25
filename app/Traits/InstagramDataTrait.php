<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

trait InstagramDataTrait
{
    public function getResponseApiData($disk, $instagramUser, $fileTimeExpiration)
    {
        if ($this->getFiles($disk)) {
            $fileName = $this->getFiles($disk)[0];
            $fileTime = explode('.', $fileName)[0];
            if ((Carbon::now()->timestamp - $fileTime) > $fileTimeExpiration) {
                $this->deleteFile($fileName, $disk);
                return $this->setResponseFile($disk, $instagramUser);
            } else {
                return $this->convertToJSON($this->getFile($fileName, $disk));
            }
        } else {
            return $this->setResponseFile($disk, $instagramUser);
        }
    }

    private function setResponseFile($disk, $instagramUser){
        $apiContent = $this->instagramApiResponse($instagramUser);
        $this->makeFile($apiContent['body'], $disk);
        return $apiContent['object'];
    }

    private function convertToJSON($file)
    {
        return json_decode($file);
    }

    private function instagramApiResponse($instagramUser)
    {
        print_r("Realizando consulta a la API instagram." . "\n");
        $apiUrl = 'https://api.instagram.com/' . $instagramUser . '/channel/?__a=1';
        $response = Http::get($apiUrl);
        return [
            'body' => $response->body(),
            'object' => $response->object()
        ];
    }

    private function makeFile($content, $disk)
    {
        $fileName = Carbon::now()->timestamp . '.txt';
        Storage::disk($disk)->put($fileName, $content);
    }

    private function deleteFile($file, $disk)
    {
        Storage::disk($disk)->delete($file);
    }

    private function getFiles($disk)
    {
        return Storage::disk($disk)->allFiles();
    }

    public function getFile($file, $disk)
    {
        return Storage::disk($disk)->get($file);
    }
}