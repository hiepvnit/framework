<?php
namespace Mage2\Framework\Image;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class ImageService extends ImageManager
{

    public $image = NULL;

    public function upload($image, $path = null, $size = null, $keepAspectRation = true)
    {


        $this->image = parent::make($image);
        $this->setSize($size);
        $this->directory(public_path($path));
        $name = $image->getClientOriginalName();

        $fullPath = public_path($path) . DIRECTORY_SEPARATOR . $name;
        $this->image->save($fullPath);

        $localImage = new LocalImageFile($path . DIRECTORY_SEPARATOR . $name);

        return $localImage;
    }

    public function directory($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, '0777', true);
        }
        return $this;
    }

    public function setSize($size)
    {
        if (null === $size) {
            return $this;
        }

        if (!is_array($size) && is_string($size)) {
            $sizePixel = config('image.sizes.' .$size);

            $this->image->resize($sizePixel, null, function ($constrain) {
                $constrain->aspectRatio();
            });
            return $this;
        }

        //if array save INTERGER SIZE

        //if array save multiple here

    }
}

