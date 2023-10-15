<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use League\Glide\Urls\UrlBuilderFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['filename'];

    protected static function booted(): void
    {
        static::deleting(function (Image $image)
        {
            Storage::disk('public')->delete($image->filename);
        });
    }

    public function getImageUrl(?int $width = null, ?int $height = null) : string
    {
        if($width === null) {
            return Storage::disk('public')->url($this->filename);
        }
        $urlBuilder = UrlBuilderFactory::create('/images/', config('glide.key'));
        return $urlBuilder->getUrl($this->filename, ['w' => $width, 'h' => $height, 'fit' => 'crop']);
    }
}
