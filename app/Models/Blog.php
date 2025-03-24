<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\CentralLogics\Helpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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
    
    public function getAuthornameAttribute($value){
        if (count($this->translations) > 0) {   
            foreach ($this->translations as $translation) {
                if ($translation['key'] == 'author_name') {
                    return $translation['value'];
                }
            }
        }

        return $value;
    }
    
    public function getBlogtitleAttribute($value){
        if (count($this->translations) > 0) {   
            foreach ($this->translations as $translation) {
                if ($translation['key'] == 'blog_title') {
                    return $translation['value'];
                }
            }
        }

        return $value;
    }

    protected static function booted()
    {
        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function ($query) {
                return $query->where('locale', app()->getLocale());
            }]);
        });
    }

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            if($model->isDirty('image')){
                $value = Helpers::getDisk();

                DB::table('storages')->updateOrInsert([
                    'data_type' => get_class($model),
                    'data_id' => $model->id,
                    'key' => 'image',
                ], [
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }

}
