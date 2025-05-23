<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyCategory extends Model {
    use SoftDeletes;
    protected $fillable = ['name_ar','name_en','parent_id','image','status','created_at','updated_at','deleted_at','sort'];
    protected $appends = ['parent_name','image_url'];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'company_categories';

    public function Parent(){
        return $this->belongsTo(self::class,'parent_id','id');
    }

    public function Companies(){
        return $this->hasMany('\App\Entities\Company','category_id','id');
    }

    public function getParentNameAttribute(){
        return $this->parent_id != null ? $this->Parent->{'name_'.LANGUAGE_PREF}  : '';
    }

    public function getImageUrlAttribute(){
        return \FilesHelper::getImagePath('company_categories',$this->id,$this->image,true);
    }
}
