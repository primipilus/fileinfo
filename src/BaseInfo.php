<?php
/**
 * @author primipilus 18.10.2016
 */

namespace primipilus\fileinfo;

use primipilus\fileinfo\exceptions\{
    FileNotExistsException, NotFileException, PropertyNotExistsException
};

/**
 * Class BaseInfo
 *
 * @property-read string $path
 *
 * @package primipilus\fileinfo
 */
trait BaseInfo
{

    /** @var string path to the file */
    protected $_path;

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
     * @param string $path
     *
     * @throws FileNotExistsException
     * @throws NotFileException
     */
    private function init(string $path)
    {
        $this->_path = $path;

        if (!file_exists($this->_path)) {
            throw new FileNotExistsException('file ' . $this->_path . ' not exists');
        }

        $type = FileTool::type($this->_path);
        if ('file' !== $type) {
            throw new NotFileException('type of ' . $this->_path . ' is ' . $type . ' (not file)');
        }
    }
}