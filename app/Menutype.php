<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Menutype extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'menutype';
    
    protected $fillable = [
          'alias',
          'description',
          'activated'
    ];
    

    public static function boot()
    {
        parent::boot();

        Menutype::observe(new UserActionsObserver);
    }
    /**
     * Get attribute from active format binary
     * @$value $input
     *
     * @return string
     */
    public function setActivatedAttribute($value){
        $this->attributes['activated'] = (empty($value) ? 0 : $value);
    }
    
    
    
    
}