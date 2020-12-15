<?php
/**
 * Created by PhpStorm.
 * User: tujailer
 * Date: 12/5/20
 * Time: 7:41 AM
 */

namespace App\Traits;


trait Error
{
    private function dataNotFound($data)
    {
        return $message = [
            'status' => 'error',
            'message' => $data . ' not found',
        ];
    }

}