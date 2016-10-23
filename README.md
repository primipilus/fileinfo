FileInfo
--------

Composer install
----------------

```bash
composer require "primipilus/fileinfo:~1.0"
```

Usage
-----

```php
$info = new FileInfo($path);

echo 'path: ' . $info->path, PHP_EOL;
echo 'mime: ' . $info->mime, PHP_EOL;
echo 'size: ' . $info->size . ' bytes', PHP_EOL;

echo 'dirname: ' . $info->dirname, PHP_EOL;
echo 'basename: ' . $info->basename, PHP_EOL;
echo 'extension: ' . $info->extension, PHP_EOL;
echo 'filename: ' . $info->filename, PHP_EOL;

if ($info->isImage) {
    echo 'width: ' . $info->image->width, PHP_EOL;
    echo 'height: ' . $info->image->height, PHP_EOL;
}

$info2 = new FileInfo($path2);

$info->equals($info2); // :bool
echo $info->sha1, PHP_EOL;
echo $info->md5, PHP_EOL;

$info->extensionCorrespondsToMime; // :bool
$info->extensionsByMime; // :string[]

```