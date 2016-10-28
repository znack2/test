<?php

namespace App;

class Url extends Eloquent {
	/**
	 * The name of the table
	 *
	 * @var integer
	 */
    protected $table = 'urls';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['url', 'hash'];
}