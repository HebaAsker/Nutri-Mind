<?php

namespace App\Traits;


trait ImageTrait
{
    public function uploadImage($image,$folder)
    {
        $extention = $image->getClientOriginalExtension();
        $path = $image->storeAs($folder, time() . '_' . uniqid().'.' . $extention, 'images');
        return $path;
    }
}
