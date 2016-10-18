<?php
/**
 * @author primipilus 18.10.2016
 */

namespace primipilus\fileinfo;

use primipilus\fileinfo\exceptions\FileNotExistsException;
use primipilus\fileinfo\exceptions\NotFileException;

/**
 * Class PathInfo
 *
 * @property-read string $dirname
 * @property-read string $basename
 * @property-read string|null $extension
 * @property-read string $filename
 *
 * @package primipilus\fileinfo
 */
class PathInfo
{

    use BaseInfo;

    /** @var string */
    protected $_dirname;
    /** @var string */
    protected $_basename;
    /** @var string|null */
    protected $_extension;
    /** @var string */
    protected $_filename;

    /**
     * PathInfo constructor.
     *
     * @param $path
     *
     * @throws FileNotExistsException
     * @throws NotFileException
     */
    public function __construct($path)
    {
        $this->init($path);

        list(
            'dirname' => $this->_dirname,
            'basename' => $this->_basename,
            'extension' => $this->_extension,
            'filename' => $this->_filename
            ) = pathinfo($path);
    }

    /**
     * @return string
     */
    public function getDirname() : string
    {
        return $this->_dirname;
    }

    /**
     * @return string
     */
    public function getBasename() : string
    {
        return $this->_basename;
    }

    /**
     * @return string|null
     */
    public function getExtension() : ?string
    {
        return $this->_extension;
    }

    /**
     * @return string
     */
    public function getFilename() : string
    {
        return $this->_filename;
    }
}