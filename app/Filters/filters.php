<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class XtraSmall implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(120, 90);
    }
}

class VerticalArtist implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(224, 336);
    }
}

class HorizontalArtist implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(960, 336);
    }
}

class SquareArtist implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(228, 228);
    }
}

class ArtistSmall implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(111, 85);
    }
}

class ArtistBig implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(480, 352);
    }
}

class ArtistFull implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->widen(600);
    }
}

class Partner implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(150, 150);
    }
}