<?php
/**
 * @author primipilus 17.10.2016
 */

namespace primipilus\fileinfo;

use primipilus\fileinfo\exceptions\FileNotExistsException;
use primipilus\fileinfo\exceptions\NotFileException;
use primipilus\fileinfo\exceptions\NullSizeException;

/**
 * Class FileInfo provides information about file
 *
 * @property-read int $size
 * @property-read string $mime
 * @property-read string $dirname
 * @property-read string $basename
 * @property-read string $extension
 * @property-read string $filename
 * @property-read bool $isImage
 * @property-read ImageInfo|null $image
 * @property-read string $sha1
 * @property-read string $md5
 * @property-read string[] $extensionsByMime
 * @property-read string $extensionCorrespondsToMime
 *
 * @package primipilus
 */
class FileInfo
{

    use BaseInfo;

    /** @var int size of the file in bytes */
    protected $_size;
    /** @var string MIME Content-type for a file */
    protected $_mime;
    /** @var PathInfo */
    protected $_info;
    /** @var ImageInfo */
    protected $_image;
    /** @var string sha1 hash sum */
    protected $_sha1;
    /** @var string md5 hash sum */
    protected $_md5;
    /** @var bool does extension corresponds to the mime type or not */
    protected $_extensionCorrespondsToMime;
    /** @var string[] of extensions corresponds to the mime */
    protected $_extensionsByMime;

    /**
     * FileInfo constructor.
     *
     * @param string $path
     *
     * @throws NullSizeException
     * @throws FileNotExistsException
     * @throws NotFileException
     */
    public function __construct(string $path)
    {
        $this->init($path);

        $this->_size = FileTool::size($this->_path);
        if (is_null($this->_size)) {
            throw new NullSizeException();
        }

        $this->_info = FileTool::info($this->_path);
        $this->_image = FileTool::image($this->_path);
        $this->_mime = $this->getIsImage() ? $this->_image->getMime() : FileTool::mime($this->_path);

        $this->_sha1 = FileTool::sha1($this->_path);
        $this->_md5 = FileTool::md5($this->_path);

        $this->_extensionCorrespondsToMime = MimeType::getMime($this->extension) === $this->_mime;

        $this->_extensionsByMime = MimeType::getExtensions($this->_mime);
    }

    /**
     * @return bool
     */
    public function getIsImage() : bool
    {
        return !is_null($this->_image);
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

    /**
     * @return ImageInfo|null
     */
    public function getImage() : ?ImageInfo
    {
        return $this->_image;
    }

    /**
     * Sha1 hash
     *
     * @return string
     */
    public function getSha1() : string
    {
        return $this->_sha1;
    }

    /**
     * Md5 hash
     *
     * @return string
     */
    public function getMd5() : string
    {
        return $this->_md5;
    }

    /**
     * @param FileInfo $info
     *
     * @return bool
     */
    public function equals(FileInfo $info) : bool
    {
        return $this->_size === $info->size && $this->_sha1 === $info->sha1 && $this->_md5 === $info->md5;
    }

    /**
     * does extension corresponds to the mime type or not
     *
     * @return boolean
     */
    public function getExtensionCorrespondsToMime() : bool
    {
        return $this->_extensionCorrespondsToMime;
    }

    /**
     * @return string[]
     */
    public function getExtensionsByMime() : array
    {
        return $this->_extensionsByMime;
    }
}