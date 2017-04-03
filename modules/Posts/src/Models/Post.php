<?php namespace Modules\Posts\Src\Models;

use Illuminate\Database\Eloquent\Model;
use Storage ;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name','slug', 'level','description'
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $fillable = ['title','slug','description','published','published_at','alt_text','published_by','updated_by','image','category_id'];
    protected $table = 'posts';

    public function getAbstractAttribute()
    {
        if(isset($this->attributes['description'])){
          str_limit($this->attributes['description'], 120);
        }
        return "---";
    }

    public function getImageAttribute()
    {
        if(isset($this->attributes['image'])){
            $filename = $this->attributes['image'];

            if(str_contains($filename, 'http')){
              return $filename;
            }

            $url = url('app/posts/',$filename);
            return $url;
        }
        return 'no url';
    }

    public function setImageAttribute($file)
    {

        if($file instanceof UploadedFile){
          // delete previous image when updating
          if (isset($this->attributes['id']) && !empty($this->attributes['image'])) {
              if (Storage::disk('posts')->has($this->attributes['image'])) {
                  Storage::disk('posts')->delete($this->attributes['image']);
              }
          }

          // Upload the new file
          $destination = time().'-'.$file->getClientOriginalName();
          $uploaded = Storage::disk('posts')->putFileAs( '', $file,$destination);
          // Update the posts entry
          $this->attributes['image'] = $uploaded;
        }else{
        $this->attributes['image'] = $file;
          
        }

    }

    public function publishedBy()
    {
        return $this->belongsTo('Modules\Users\Src\Models\User','published_by');
    }

      public function updatedBy()
    {
        return $this->belongsTo('Modules\Users\Src\Models\User','updated_by');
    }


    public function delete()
    {
      if (isset($this->attributes['id']) && !empty($this->attributes['image'])) {
            if (Storage::disk('posts')->has($this->attributes['image'])) {
                Storage::disk('posts')->delete($this->attributes['image']);
            }
      }
      parent::delete();
    }


    public function sluggable()
    {
      return [
        'slug' => [
          'source' => 'title'
        ]
      ];
    }

    public function getTagIdsAttribute()
    {
      return $this->tags->map(function($t){ return $t->id; })->toArray();
    }



    public function category()
    {
      return $this->belongsTo('Modules\Categories\Src\Models\Category');
    }

    public function tags()
    {
      return $this->belongsToMany('Modules\Tags\Src\Models\Tag');
    }
}
