<?php

namespace Mage2\Framework\Image;

class LocalImageFile {


    public $relativePath = NULL;

    public $url = NULL;

    public function __construct($relativePath = NULL) {

        $this->relativePath = $relativePath;
        $this->url = asset($relativePath);
    }

 }