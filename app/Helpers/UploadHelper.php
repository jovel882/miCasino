<?php

namespace App\Helpers;

class UploadHelper
{
    public static function maxUploadSize()
    {
        $maxUpload = (int)(ini_get('upload_max_filesize'));
        $maxPost = (int)(ini_get('post_max_size'));
        $memoryLimit = (int)(ini_get('memory_limit'));

        return min($maxUpload, $maxPost, $memoryLimit);
    }
}
