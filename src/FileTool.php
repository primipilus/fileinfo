<?php
/**
 * @author primipilus 18.10.2016
 */

namespace primipilus\fileinfo;

use primipilus\fileinfo\exceptions\FileNotExistsException;
use primipilus\fileinfo\exceptions\NotFileException;
use primipilus\fileinfo\exceptions\NotImageException;

/**
 * Class FileTool
 *
 * @package primipilus\fileinfo
 */
class FileTool
{

    /**
     * @param string $path
     *
     * @return string
     */
    public static function type(string $path) : string
    {
        return filetype($path);
    }

    /**
     * @param string $path
     *
     * @return int|null
     */
    public static function size(string $path) : ?int
    {
        $size = filesize($path);
        return $size === false ? null : $size;
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public static function exists(string $path) : bool
    {
        return file_exists($path);
    }

    /**
     * @param $path
     *
     * @return string
     */
    public static function mime(string $path) : string
    {
        return mime_content_type($path);
    }

    /**
     * @param $path
     *
     * @return PathInfo
     *
     * @throws FileNotExistsException
     * @throws NotFileException
     */
    public static function info(string $path) : PathInfo
    {
        return new PathInfo($path);
    }

    /**
     * @param string $path
     *
     * @return ImageInfo|null
     *
     * @throws FileNotExistsException
     * @throws NotFileException
     */
    public static function image(string $path) : ?ImageInfo
    {
        try {
            return new ImageInfo($path);
        } catch (NotImageException $e) {
            return null;
        }
    }

    /**
     * Calculate the sha1 hash of a file
     *
     * @param string $path
     *
     * @return null|string
     */
    public static function sha1(string $path) : ?string
    {
        return sha1_file($path) ?: null;
    }

    /**
     * Calculates the md5 hash of a given file
     *
     * @param string $path
     *
     * @return null|string
     */
    public static function md5(string $path) : ?string
    {
        return md5_file($path) ?: null;
    }
}