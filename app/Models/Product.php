<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory , HasTranslations;
    public $translatable = ['title' , 'description'];

    protected $guarded = [];

    public function getImageAttribute($key)
    {
        return asset($key);
    }

    public function Iamges(){
        return $this->hasMany(ProductFile::class);
    }
}
