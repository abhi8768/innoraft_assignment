<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'id',
    	'name',
    	'email',
    	'logo',
    	'website',
    	'created_at',
    	'updated_at',
    	'deleted_at',
    ];
    protected $guarded = [];

}
