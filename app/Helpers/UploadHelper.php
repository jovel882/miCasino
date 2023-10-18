<?php

namespace App\Helpers;

class UploadHelper
{
    public static function maxUploadSize()
    {
        $max_upload = (int)(ini_get('upload_max_filesize'));
        $max_post = (int)(ini_get('post_max_size'));
        $memory_limit = (int)(ini_get('memory_limit'));

        return min($max_upload, $max_post, $memory_limit);
    }
}