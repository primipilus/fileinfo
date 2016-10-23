<?php
/**
 * @author primipilus 18.10.2016
 */

use primipilus\fileinfo\FileInfo;

require dirname(__DIR__) . '/vendor/autoload.php';

$info2 = new FileInfo(__DIR__ . '/09t64cB.jpg');

foreach ([dirname(__DIR__) . '/README.md', __DIR__ . '/09t64cB.jpg'] as $file) {
    $info = new FileInfo($file);

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

    echo $info->md5, PHP_EOL;
    echo $info->sha1, PHP_EOL;
    echo $info->equals($info2) ? 'true' : 'false', PHP_EOL;

    echo $info->extensionCorrespondsToMime ? 'true' : 'false', PHP_EOL;
    var_dump($info->extensionsByMime);

    echo '-----------------', PHP_EOL;
}