<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'type_id',
        'brand_id',
        'photos',
        'features',
        'price',
        'star',
        'review',
    ];

    protected $casts = [
        'photos' => 'array',
    ]; 

    public function getThumbnailAttribute() //thumbnail
    {
        if($this->photos){
            return Storage::url(json_decode($this->photos)[0]);
        }
        return 'https://via.placeholder.com/800x600.png?text=No+Image';
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'item_id', 'id');
    }
}
