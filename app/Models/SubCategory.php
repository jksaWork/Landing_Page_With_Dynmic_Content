<?php

namespace App\Models;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SubCategory extends Model
{
    use HasFactory, HasTranslations, HasStatus;
    public $translatable = ['name'];
    public $fillable = ['name', 'status', 'category_id'];
    public function Category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}