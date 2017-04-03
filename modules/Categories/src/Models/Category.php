<?php namespace Modules\Categories\Src\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;


class Category extends Model
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];


    public function sluggable()
    {
      return [
        'slug' => [
          'source' => 'name'
        ]
      ];
    }

}
