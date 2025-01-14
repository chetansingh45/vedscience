<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feed;

class FeedCategory extends Model
{
   
    use HasFactory;
    protected $table = 'feed_categories';

    protected $fillable = [
        'name',
    ];

    public function feeds(){
        return $this->hasMany(Feed::class,'feed_cat_id');
    }
}
