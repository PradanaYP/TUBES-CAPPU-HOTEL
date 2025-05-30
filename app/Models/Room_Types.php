<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room_Types extends Model
{   
    protected $fillable = [
        'type_name',
        'description',
        'price_per_night',
        'overview_image',
        'gallery_image_1',
        'gallery_image_2',
        'gallery_image_3'
    ];
    
    public function rooms()
    {
        return $this->hasMany(Rooms::class, 'roomtype_id');
    }

    public function getGalleryImages()
    {
        return array_filter([
            $this->gallery_image_1,
            $this->gallery_image_2,
            $this->gallery_image_3
        ]);
    }

    public function hasOverviewImage()
    {
        return !empty($this->overview_image);
    }
}
