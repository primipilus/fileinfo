<?php
/**
 * @author primipilus 18.10.2016
 */

namespace primipilus\fileinfo;

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
    public static function exists($path) : bool
    {
        return file_exists($path);
    }

    /**
     * @param $path
     *
     * @return string
     */
    public static function mime($path) : string
    {
        return mime_content_type($path);
    }

    /**
     * @param $path
     *
     * @return PathInfo
     */
    public static function info($path) : PathInfo
    {
        return new PathInfo($path);
    }
}