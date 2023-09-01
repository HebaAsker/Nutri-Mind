<?php

namespace App\Traits;




trait ImageTrait
{
    function saveImage($image, $folder)
    {
        if ($image) {
            $extension = $image->getClientOriginalExtension();
            $file_name = time() . '.' . $extension; //the file name will be the time at which the file uploaded+ the file extension
            $path = $folder;
            $image->move($path, $file_name);
            return $file_name;
        } else {
            $default = 'images/profileImages/profile.png';
            return $default;
        }

    }
    public function uploadImage($image,$folder)
    {
        $extention = $image->getClientOriginalExtension();
        $path = $image->storeAs($folder, time() . '_' . uniqid().'.' . $extention, 'images');
        return $path;
    }
}
