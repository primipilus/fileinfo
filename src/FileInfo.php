<?php
/**
 * @author primipilus 17.10.2016
 */

namespace primipilus\fileinfo;

use primipilus\fileinfo\exceptions\{
    FileNotExistsException, NotFileException, NullSizeException, PropertyNotExistsException
};

/**
 * Class FileInfo provides information about file
 *
 * @property-read string $path
 * @property-read int $size
 * @property-read string $mime
 * @property-read string $dirname
 * @property-read string $basename
 * @property-read string $extension
 * @property-read string $filename
 *
 * @package primipilus
 */
class FileInfo
{
    /** @var string path to the file */
    protected $_path;
    /** @var int size of the file in bytes */
    protected $_size;
    /** @var string MIME Content-type for a file */
    protected $_mime;
    /** @var PathInfo */
    protected $_info;

    public function __construct(string $path)
    {
        $this->_path = $path;

        if (!file_exists($this->_path)) {
            throw new FileNotExistsException('file ' . $this->_path . ' not exists');
        }

        $type = FileTool::type($this->_path);
        if ('file' !== $type) {
            throw new NotFileException('type of ' . $this->_path . ' is ' . $type . ' (not file)');
        }

        $this->_size = FileTool::size($this->_path);
        if (is_null($this->_size)) {
            throw new NullSizeException();
        }

        $this->_mime = FileTool::mime($this->_path);

        $this->_info = FileTool::info($this->_path);
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
    public function getPath() : string
    {
        return $this->_path;
    }

    /**
     * @return int
     */
    public function getSize() : int
    {
        return $this->_size;
    }

    /**
     * @return string
     */
    public function getMime() : string
    {
        return $this->_mime;
    }

    /**
     * @return string
     */
    public function getDirname() : string
    {
        return $this->_info->getDirname();
    }

    /**
     * @return string
     */
    public function getBasename() : string
    {
        return $this->_info->getBasename();
    }

    /**
     * @return string
     */
    public function getExtension() : ?string
    {
        return $this->_info->getExtension();
    }

    /**
     * @return string
     */
    public function getFilename() : string
    {
        return $this->_info->getFilename();
    }
}