<?php


namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;
use App\Http\Requests;

class ImageResize implements FilterInterface
{
    public function applyFilter(Image $image, Request $request)
    {	

        return $image->fit(120, 90)->greyscale();
    }
}