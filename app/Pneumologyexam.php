<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Pneumologyexam extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'pneumologyexam';
    
    protected $fillable = [
          'dyspne',
          'toux',
          'hoqqet',
          'consultation_id',
          'speciality_id'
    ];
    

    public static function boot()
    {
        parent::boot();

        Pneumologyexam::observe(new UserActionsObserver);
    }
    
    public function consultation()
    {
        return $this->hasOne('App\Consultation', 'id', 'consultation_id');
    }


    public function speciality()
    {
        return $this->hasOne('App\Speciality', 'id', 'speciality_id');
    }


    
    
    
}