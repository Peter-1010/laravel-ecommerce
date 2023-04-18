<?php

define('PAGINATION_COUNT', 30);

function getFolder(){
    return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
}

function getTextDirection(){
    return app()->getLocale() === 'ar' ? 'rtl' : 'ltr';
}

function getDirection(){
    return app()->getLocale() === 'ar' ? 'right' : 'left';
}

function getDirectionReverse(){
    return app()->getLocale() === 'ar' ? 'left' : 'right';
}

function uploadImage($folder,$image){
    $image->store('/', $folder);
    $filename = $image->hashName();
    return  $filename;
}

