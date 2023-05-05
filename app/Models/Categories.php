<?php

namespace App\Models;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Categories extends Model
{
    use HasFactory, HasTranslations, HasStatus;
    public $translatable = ['name'];
    public $fillable = ['name', 'status'];

    public function SubCategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}