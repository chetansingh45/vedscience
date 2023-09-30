<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_id',
        'name',
        'book'
    ];

    public function getBookAttribute($value){
        return asset('storage/'.$value);
    }

    public function category(){
        return $this->belongsTo(Category::class,'cat_id',);
    }
}
