<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {
    use SoftDeletes;
    protected $fillable = ['name','email','phone','service_id','message','status','created_at','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'orders';
    protected $appends = ['service_name'];

    public function Service(){
        return $this->belongsTo('App\Entities\Service','service_id','id');
    }

    public function getServiceNameAttribute(){
        return $this->Service->{'name_'.LANGUAGE_PREF};
    }

}
