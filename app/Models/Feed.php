<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FeedCategory;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = [ 'feed_cat_id','title', 'slug','description', 'status','tags','main_image','thumbnail_image'];

    protected $casts = [
        'tags' => 'array',
    ];
    
    public function getfeedAttribute($value){
        return asset('storage/'.$value);
    }


    public function feedcategory(){
        return $this->belongsTo(FeedCategory::class,'feed_cat_id',);
    }
}
