<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model {
    use SoftDeletes;
    protected $fillable = ['title_ar','title_en','description_ar','description_en','page_id','image','status','created_at','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'sliders';
    protected $appends = ['page_name','image_url'];

    public function Page(){
        return $this->belongsTo('App\Entities\Page','page_id','id');
    }

    public function getImageUrlAttribute(){
        return \FilesHelper::getImagePath('sliders',$this->id,$this->image,true);
    }

    public function getPageNameAttribute(){
        return $this->Page->{'name_'.LANGUAGE_PREF};
    }

}
