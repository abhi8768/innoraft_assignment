<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id',
    	'first_name',
    	'last_name',
    	'comapny_id',
    	'email',
        'phone',
    	'created_at',
    	'updated_at',
    	'deleted_at',
    ];
    protected $guarded = [];
}
