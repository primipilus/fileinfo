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
$info = new FileInfo(dirname(__DIR__) . '/README.md');

echo 'path: ' . $info->path, PHP_EOL;
echo 'mime: ' . $info->mime, PHP_EOL;
echo 'size: ' . $info->size . ' bytes', PHP_EOL;

echo 'dirname: ' . $info->dirname, PHP_EOL;
echo 'basename: ' . $info->basename, PHP_EOL;
echo 'extension: ' . $info->extension, PHP_EOL;
echo 'filename: ' . $info->filename, PHP_EOL;
```