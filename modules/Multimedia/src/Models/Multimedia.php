<?php namespace Modules\Multimedia\Src\Models;

use Illuminate\Database\Eloquent\Model;
use Storage ;
use Symfony\Component\HttpFoundation\File\UploadedFile;
//use Image ;
class Multimedia extends Model
{
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
    protected $fillable = ['title','url','description','mime_type','dimensions','alt_text','uploaded_by'];
    protected $table =  'multimedias';
    protected $appends = ['dimensions'];
    public function getUrlAttribute()
    {
        if(isset($this->attributes['url'])){
            $filename = $this->attributes['url'];

            $url = Storage::disk('media')->url($filename);
            return $url;
        }
        return 'no url';
    }

    public function setUrlAttribute(UploadedFile $file)
    {
          // delete previous image when updating
        if (isset($this->attributes['id']) && !empty($this->attributes['url'])) {
            if (Storage::disk('media')->has($this->attributes['url'])) {
                Storage::disk('media')->delete($this->attributes['url']);
            }
        }

        // Upload the new file
        $destination = time().'-'.$file->getClientOriginalName();
        $uploaded = Storage::disk('media')->putFileAs( '', $file,$destination);
        // Update the media entry
        $this->attributes['url'] = $uploaded;
    }
    public function uploadedBy()
    {
        return $this->belongsTo('Modules\Users\Src\Models\User','uploaded_by');
    }


    public function getDimensionsAttribute()
    {
      
      return "No specified";
    }

    public function delete()
    {
      if (isset($this->attributes['id']) && !empty($this->attributes['url'])) {
            if (Storage::disk('media')->has($this->attributes['url'])) {
                Storage::disk('media')->delete($this->attributes['url']);
            }
      }
      parent::delete();
    }
}
