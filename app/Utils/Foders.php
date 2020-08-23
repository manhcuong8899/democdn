<?php
/**
 * Created by PhpStorm.
 * User: CUONGHM
 * Date: 8/14/2016
 * Time: 8:21 AM
 */

namespace Fully\Utils;
use Illuminate\Support\Facades\File;


class Foders {

    public function makeDirectory($path, $mode = 0777, $recursive = false, $force = false)
    {
        if ($force)
        {
            return @mkdir($path, $mode, $recursive);
        }
        else
        {
            return mkdir($path, $mode, $recursive);
        }
    }

    public function deleteDirectory($directory, $preserve = false)
    {
        return true;
    }

}