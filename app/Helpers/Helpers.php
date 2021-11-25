<?php
use App\Helpers\ViewHelper;
use App\Helpers\AuthHelper;
use App\Helpers\CacheHelper;
use App\Helpers\CrudHelper;
use App\Helpers\ImageHelper;
use App\Helpers\MenuHelper;
use App\Helpers\PageHelper;
use App\Helpers\UtilsHelper;
use App\Helpers\MailHelper;

/**
 * PageHelper
 */

if (!function_exists('getBladePath')) {
    function getBladePath($page)
    {
        return PageHelper::getBladePath($page);
    }
}

if (!function_exists('getBladeTemplatePath')) {
    function getBladeTemplatePath($page)
    {
        return PageHelper::getBladeTemplatePath($page);
    }
}

if (!function_exists('getDirectoryBladePath')) {
    function getDirectoryBladePath($page)
    {
        return PageHelper::getDirectoryBladePath($page);
    }
}

if (!function_exists('getNofollowPage')) {
    function getNofollowPage($value)
    {
        return PageHelper::getNofollowPage($value);
    }
}

if (!function_exists('makeUrl')) {
    function makeUrl($pageName = 'Home', $slugFirstObject = null, $slugSecondObject = null)
    {
        return PageHelper::makeUrl($pageName, $slugFirstObject, $slugSecondObject);
    }
}

if (!function_exists('makeBreadcrumbs')) {
    function makeBreadcrumbs(
        $pageName = 'Home',
        $slugFirstObject = null,
        $nameFirstObject = "Object",
        $slugSecondObject = null,
        $nameSecondObject = "Object"
    ) {
        return PageHelper::makeBreadcrumbs($pageName, $slugFirstObject, $nameFirstObject, $slugSecondObject,
            $nameSecondObject);
    }
}

if (!function_exists('translateUrl')) {
    function translateUrl($locale, $pageName, $slugObject, $slugEntityObject = null)
    {
        return PageHelper::translateUrl($locale, $pageName, $slugObject, $slugEntityObject);
    }
}

if (!function_exists('urlLastSegment')) {
    function urlLastSegment($url)
    {
        return PageHelper::urlLastSegment($url);
    }
}

if (!function_exists('getSegments')) {
    function getSegments($url)
    {
        return PageHelper::getSegments($url);
    }
}

if (!function_exists('getUrlTranslateds')) {
    function getUrlTranslateds($page, $pageSlug)
    {
        return PageHelper::getUrlTranslateds($page, $pageSlug);
    }
}

if (!function_exists('checkIfPageRequireAuthentication')) {
    function checkIfPageRequireAuthentication($page)
    {
        return PageHelper::checkIfPageRequireAuthentication($page);
    }
}


/**
 * CrudHelper
 */

if (!function_exists('toggleField')) {
    function toggleField($request)
    {
        return CrudHelper::toggleField($request);
    }
}

if (!function_exists('settingTypeSelect')) {
    function settingTypeSelect($value)
    {
        return CrudHelper::settingTypeSelect($value);
    }
}

if (!function_exists('storeReplicateOtherLocales')) {
    function storeReplicateOtherLocales($crud)
    {
        return CrudHelper::storeReplicateOtherLocales($crud);
    }
}

if (!function_exists('getUniqueSlug')) {
    function getUniqueSlug($objectId, $slug, $model, $i = 0, $first = true)
    {
        return CrudHelper::getUniqueSlug($objectId, $slug, $model, $i, $first);
    }
}

if (!function_exists('getNextID')) {
    function getNextID($table_name)
    {
        return CrudHelper::getNextID($table_name);
    }
}


/**
 * AuthHelper
 */

if (!function_exists('isAdmin')) {
    function isAdmin($user = null)
    {
        return AuthHelper::isAdmin($user);
    }
}

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin($user = null)
    {
        return AuthHelper::isSuperAdmin($user);
    }
}

if (!function_exists('isAdminOrSuperadmin')) {
    function isAdminOrSuperadmin($user = null)
    {
        return AuthHelper::isAdminOrSuperadmin($user);
    }
}

if (!function_exists('userIsActive')) {
    function userIsActive($user)
    {
        return AuthHelper::userIsActive($user);
    }
}

if (!function_exists('getUser')) {
    function getUser()
    {
        return AuthHelper::getUser();
    }
}


/**
 * UtilsHelper
 */

if (!function_exists('saveFile')) {
    function saveFile($file, $path, $filename, $disk)
    {
        UtilsHelper::saveFile($file, $path, $filename, $disk);
    }
}

if (!function_exists('getRouteBySlug')) {
    function getRouteBySlug($slug, $locale = null)
    {
        return UtilsHelper::getRouteBySlug($slug, $locale);
    }
}

if (!function_exists('getTitleInLocale')) {
    function getTitleInLocale($pageSlug, $locale)
    {
        return UtilsHelper::getTitleInLocale($pageSlug, $locale);
    }
}

if (!function_exists('dateNow')) {
    function dateNow()
    {
        return UtilsHelper::dateNow();
    }
}

if (!function_exists('checkParam')) {
    function checkParam($param)
    {
        return UtilsHelper::checkParam($param);
    }
}

if (!function_exists('isJson')) {
    function isJson($json)
    {
        return UtilsHelper::isJson($json);
    }
}

if (!function_exists('checkRgpd')) {
    function checkRgpd($consent, $email, $name = null, $phone = null)
    {
        return UtilsHelper::checkRgpd($consent, $email, $name, $phone);
    }
}

if (!function_exists('getExtensionByMimetype')) {
    function getExtensionByMimetype($mime)
    {
        return UtilsHelper::getExtensionByMimetype($mime);
    }
}

if (!function_exists('getClassName')) {
    function getClassName($object)
    {
        return UtilsHelper::getClassName($object);
    }
}

if (!function_exists('getEmailsToSendForm')) {
    function getEmailsToSendForm($form)
    {
        return UtilsHelper::getEmailsToSendForm($form);
    }
}

if (!function_exists('getTimeElapsed')) {
    function getTimeElapsed()
    {
        return UtilsHelper::getTimeElapsed();
    }
}

if (!function_exists('getPosixTimeSince')) {
    function getPosixTimeSince($time = null)
    {
        return UtilsHelper::getPosixTimeSince($time);
    }
}

if (!function_exists('uploadFormFile')) {
    function uploadFormFile($request, $disk)
    {
        return UtilsHelper::uploadFormFile($request, $disk);
    }
}

if (!function_exists('injectSvg')) {
    function injectSvg($path)
    {
        return UtilsHelper::injectSvg($path);
    }
}

if (!function_exists('generateRandomToken')) {
    function generateRandomToken()
    {
        return UtilsHelper::generateRandomToken();
    }
}

if (!function_exists('generateQR')) {
    function generateQR($url, $size)
    {
        return UtilsHelper::generateQR($url, $size);
    }
}

/**
 * ImageHelper
 */

if (!function_exists('generateMobileImage')) {
    function generateMobileImage($disk, $image, $filename, $destination_path)
    {
        return ImageHelper::generateMobileImage($disk, $image, $filename, $destination_path);
    }
}

if (!function_exists('generateThumbnailImage')) {
    function generateThumbnailImage($disk, $image, $filename, $destination_path)
    {
        return ImageHelper::generateThumbnailImage($disk, $image, $filename, $destination_path);
    }
}

if (!function_exists('addToNameImage')) {
    function addToNameImage($filename, $addToFileName, $extension)
    {
        return ImageHelper::addToNameImage($filename, $addToFileName, $extension);
    }
}

if (!function_exists('saveImage')) {
    function saveImage($disk, $path, $image)
    {
        return ImageHelper::saveImage($disk, $path, $image);
    }
}

if (!function_exists('resizeImage')) {
    function resizeImage($image, $maxWidth = null, $maxHeigth = null)
    {
        return ImageHelper::resizeImage($image, $maxWidth, $maxHeigth);
    }
}

if (!function_exists('deleteImage')) {
    function deleteImage($disk, $path)
    {
        return ImageHelper::deleteImage($disk, $path);
    }
}

if (!function_exists('getPathImage')) {
    function getPathImage($path)
    {
        return ImageHelper::getPathImage($path);
    }
}

if (!function_exists('ifDirectoryEmptyDelete')) {
    function ifDirectoryEmptyDelete($path)
    {
        return ImageHelper::ifDirectoryEmptyDelete($path);
    }
}


/**
 * MenuHelper
 */

if (!function_exists('getMenuTop')) {
    function getMenuTop()
    {
        return MenuHelper::getMenuTop();
    }
}

if (!function_exists('getMenuFooter')) {
    function getMenuFooter()
    {
        return MenuHelper::getMenuFooter();
    }
}

if (!function_exists('getRrss')) {
    function getRrss()
    {
        return MenuHelper::getRrss();
    }
}


/**
 * CacheHelper
 */

if (!function_exists('cacheKeyExists')) {
    function cacheKeyExists($key)
    {
        return CacheHelper::cacheKeyExists($key);
    }
}

if (!function_exists('getCacheKey')) {
    function getCacheKey($key)
    {
        return CacheHelper::getCacheKey($key);
    }
}

/*
if (!function_exists('storeInCache')) {
    function storeInCache($key, $query, $ttl = null)
    {
        return CacheHelper::storeInCache($key, $query, $ttl);
    }
}
*/

if (!function_exists('forceStoreInCache')) {
    function forceStoreInCache($tag, $query, $ttl = null)
    {
        return CacheHelper::forceStoreInCache($tag, $query, $ttl);
    }
}

if (!function_exists('deleteItemFromCache')) {
    function deleteItemFromCache($key)
    {
        return CacheHelper::deleteItemFromCache($key);
    }
}

if (!function_exists('clearCache')) {
    function clearCache()
    {
        return CacheHelper::clearCache();
    }
}


/**
 * MailHelper
 */
if (!function_exists('sendEmail')) {
    function sendEmail($data, $subject, $to = [], $formType = 'default-content', $fromAddress = null, $fromName = null, $bcc = [])
    {
        return MailHelper::sendEmail($data, $subject, $to, $formType, $fromAddress, $fromName, $bcc);
    }
}

if (!function_exists('sendEmailError')) {
    function sendEmailError($subject, $data)
    {
        return MailHelper::sendEmailError($subject, $data);
    }
}

/* ViewHelper */

if (!function_exists('renderView')) {
    function renderView($blade, $arg = null)
    {
        return ViewHelper::renderView($blade, $arg);
    }
}