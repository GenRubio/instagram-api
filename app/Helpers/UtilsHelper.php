<?php

namespace App\Helpers;

use Exception;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\Rgpd;
use App\Models\PresetEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UtilsHelper
{
    public static function saveFile($file, $path, $filename, $disk): void
    {
        $file->storeAs($path, $filename, $disk);
    }

    static function getEmailsToSendForm($form)
    {
        return PresetEmail::whereForm($form)->active()->pluck('email')->toArray();
    }

    static function getRouteBySlug($slug, $locale = null)
    {
        $returnSlug = "";
        $return = true;
        $locale = $locale ?? LaravelLocalization::getCurrentLocale();
        if ($slug == "home") {
            $returnSlug = "";
        } else {
            $page = Page::findSlug($slug);
            if (!is_null($page) && !($page instanceof Builder)) {
                $returnSlug = $page->getTranslation('slug', $locale);
                if (!is_null($page->parent_id)) {
                    $pageParent = Page::find($page->parent_id);
                    if (!is_null($pageParent)) {
                        $parentSlug = $pageParent->getTranslation('slug', $locale);
                        $returnSlug = $parentSlug . '/' . $returnSlug;
                    }
                }
            } else {
                $return = false;
            }
        }

        if ($return) {
            $return = LaravelLocalization::localizeUrl(($returnSlug == 'home' ? url('') : url($returnSlug)), $locale);
        }
        return $return;
    }

    static function getTitleInLocale($pageSlug, $locale)
    {
        $return = null;
        $page = Page::findBySlug($pageSlug);
        if (!is_null($page) && !($page instanceof Builder)) {
            $return = $page->getTranslation('title', $locale);
        }
        return $return;
    }

    static function dateNow()
    {
        return Carbon::now('Europe/Madrid')->format('Y-m-d H:i:s');
    }

    static function checkParam($param)
    {
        return (!is_null($param) && $param != "") ? $param : null;
    }

    static function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public static function checkRgpd($consent, $email, $name = null, $phone = null)
    {
        $rgpd = Rgpd::firstOrCreate(['email' => $email, 'phone' => $phone]);

        $rgpd->update([
            'name' => $name,
            'ip_consent' => (isset($_SERVER['HTTP_X_REAL_IP'])) ? $_SERVER['HTTP_X_REAL_IP'] : $_SERVER['REMOTE_ADDR'],
            'consent' => $consent,
            'datetime_consent' => Carbon::now('Europe/Madrid'),
            'active' => 1
        ]);
        return true;
    }

    public static function getExtensionByMimetype($mime)
    {
        if ($mime == 'image/jpeg') {
            $extension = '.jpg';
        } elseif ($mime == 'image/png') {
            $extension = '.png';
        } elseif ($mime == 'image/gif') {
            $extension = '.gif';
        } else {
            $extension = '';
        }
        return $extension;
    }

    public static function getClassName($object)
    {
        $path = explode('\\', get_class($object));
        return array_pop($path);
    }

    public static function getTimeElapsed()
    {
        return sprintf("%.2f", microtime(true) - LARAVEL_START);
    }

    public static function getPosixTimeSince($time = null)
    {
        $carbon = Carbon::now();
        switch ($time) {
            case 'hour':
                $date = $carbon->subHour()->format('Y-m-d H:00:00');
                break;
            case 'day':
                $date = $carbon->today();
                break;
            case 'yesterday':
                $date = $carbon->yesterday();
                break;
            case 'week':
                $date = $carbon->today()->subWeek();
                break;
            case 'month':
                $date = $carbon->subMonth();
                break;
            default:
                $date = $carbon->createFromTimestamp(1);
                break;
        }
        return $date->timestamp;
    }

    public static function uploadFormFile($request, $disk)
    {
        try {
            $file = $request->file('image');
            $fileOriginalName = $request->file('image')->getClientOriginalName();
            $filename = Str::slug(pathinfo($fileOriginalName, PATHINFO_FILENAME));
            $extension = pathinfo($fileOriginalName, PATHINFO_EXTENSION);
            $fileFullName = $filename . '-' . Str::random(10) . '.' . $extension;
            saveFile($file, '', $fileFullName, $disk);
            $path = Storage::disk($disk)->url($fileFullName);
            return $path;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function injectSvg($path)
    {
        return file_get_contents($path);
    }

    public static function generateRandomToken()
    {
        return md5(rand(1, 10) . microtime());
    }

    public static function generateQR($url, $size)
    {
        return QrCode::size($size)->generate($url);
    }
}
