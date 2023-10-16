<?php

namespace App\Models;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperProperty
 */
class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'surface',
        'rooms',
        'bedrooms',
        'floor',
        'price',
        'city',
        'address',
        'postal_code',
        'sold'
    ];

    public function options() : BelongsToMany {
        return $this->belongsToMany(Option::class);
    }

    public function getSlug(): string {
        return Str::slug($this->title);
    }

    public function images(): HasMany
    {
        return $this->HasMany(Image::class);
    }

    /**
     * @param \Illuminate\Http\UploadedFile $files
     */
    public function attachFiles(array $files)
    {
        foreach($files as $file) {
            if($file->getError()) {
                continue;
            }
            $filename = $file->store('properties/' .  $this->id, 'public');
            $images[] = [
                'filename' => $filename
            ];
        }
        if(count($images) > 0) {
            $this->images()->createMany($images);
        }
    }

    public function getImage() : ?Image
    {
        return $this->images[0] ?? null;
    }

    //filtrer les biens disponibles
    public function scopeAvailable(Builder $builder)
    {
        return $builder->where('sold', false);
    }

    public function scopeRecent(Builder $builder)
    {
        return $builder->orderBy('created_at', 'desc');
    }
}
