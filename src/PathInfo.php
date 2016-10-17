<?php
/**
 * @author primipilus 18.10.2016
 */

namespace primipilus\fileinfo;

use primipilus\fileinfo\exceptions\ {
    FileNotExistsException,
    PropertyNotExistsException
};

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
    /** @var string */
    protected $_dirname;
    /** @var string */
    protected $_basename;
    /** @var string|null */
    protected $_extension;
    /** @var string */
    protected $_filename;

    public function __construct($path)
    {
        if (!file_exists($path)) {
            throw new FileNotExistsException('file ' . $path . ' not exists');
        }

        list(
            'dirname' => $this->_dirname,
            'basename' => $this->_basename,
            'extension' => $this->_extension,
            'filename' => $this->_filename
            ) = pathinfo($path);
    }

    public function __get(string $name)
    {
        $method = 'get' . $name;
        if (method_exists($this, $method)) {
            return call_user_func([$this, $method]);
        }

        throw new PropertyNotExistsException();
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