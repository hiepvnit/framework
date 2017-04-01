<?php

namespace Mage2\Framework\Image;

use Illuminate\Http\UploadedFile;

class ImageService
{


    protected $image = NULL;


    public function make($relativePath = "") {
        dd($relativePath);
    }

    public function upload(UploadedFile $image, $type="catalog") {


        $destinationPath = 'uploads/';
        $relativePath = implode('/', str_split(strtolower(str_random(3)))) . '/';
        $image->move($destinationPath . $relativePath, $image->getClientOriginalName());


        $relativePath = $relativePath . $image->getClientOriginalName();

        $localImage = new LocalImageFile($relativePath, $type);

        $this->image = $localImage;


        return $this;
    }



    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        if($this->image->$key) {
            return $this->image->$key;
        }

        if($key = "url") {
            return $this->image->url();
        }


        return null;
    }
}

