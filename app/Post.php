<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id', 'title', 'text', 'category_id', 'user_id', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
