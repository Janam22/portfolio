<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\CentralLogics\Helpers;

class Blog extends Model
{
    use HasFactory;

    protected $appends = ['image_full_url'];

    public function getImageFullUrlAttribute(){
        $value = $this->blog_image;
        if (count($this->storage) > 0) {
            foreach ($this->storage as $storage) {
                if ($storage['key'] == 'image') {
                    return Helpers::get_full_url('blog',$value,$storage['value']);
                }
            }
        }

        return Helpers::get_full_url('blog',$value,'public');
    }

    public function storage()
    {
        return $this->morphMany(Storage::class, 'data');
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }
    
    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }

}
