<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model {
    use SoftDeletes;
    protected $fillable = ['name_ar','name_en','description_ar','description_en','category_id','status','image','views','rate','location','phone','email','website','whatsapp','facebook','twitter','linkedin','instagram','created_at','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'companies';
    protected $appends = ['category_name','image_url'];

    public function Category(){
        return $this->belongsTo("App\Entities\CompanyCategory",'category_id','id');
    }

    public function getCategoryNameAttribute(){
        return $this->Category ? $this->Category->{'name_'.LANGUAGE_PREF} : '';
    }

    public function getImageUrlAttribute(){
        return \FilesHelper::getImagePath('companies',$this->id,$this->image,true);
    }

    public function increaseViews(){
        return $this->update(['views'=> ($this->views+1) ]);
    }
}
