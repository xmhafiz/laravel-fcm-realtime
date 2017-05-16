<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	// use mass assignment https://laravel.com/docs/5.4/eloquent#mass-assignment
    protected $fillable = [
    	'report_title',
    	'report_description',
    	'address',
    	'longitude',
    	'latitude',
    ];

    protected $appends = ['created_at_formatted'];

    public function getCreatedAtFormattedAttribute() 
    {
    	return date('l, j F Y, g:i a', strtotime($this->attributes['created_at']));
    }
}
