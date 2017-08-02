<?php

namespace ByTIC\RequestDetective\Malicious\Sensors;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class BasicUri
 * @package ByTIC\RequestDetective
 */
class BasicUri
{
    /**
     * @param Request $request
     * @return bool
     */
    public static function check($request)
    {
        $uri = self::getPathFromRequest($request);
        if (in_array($uri, self::getMaliciousUriArray())) {
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    public static function getMaliciousUriArray()
    {
        return array_merge(self::getGenericList(), self::getWordpressList());
    }

    /**
     * Get the current path info for the request.
     *
     * @param Request $request
     * @return string
     */
    public static function getPathFromRequest($request)
    {
        $pattern = ltrim($request->getPathInfo(), '/');
        return $pattern == '' ? '/' : '/' . $pattern;
    }

    /**
     * @return array
     */
    public static function getWordpressList()
    {
        return [
            '/wp-login.php',
            '/wp-admin/',
            '/xmlrpc.php',
            '/old/wp-admin/',
            '/wp/wp-admin/',
            '/wordpress/wp-admin/',
            '/blog/wp-admin/',
            '/test/wp-admin/',
        ];
    }

    /**
     * @return array
     */
    public static function getGenericList()
    {
        return [
            '/openserver/',
            '/recordings/LICENSE.txt',
            '/webdav/',
            '/license.txt',
            '/hetlerx.php',
        ];
    }
}
