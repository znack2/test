<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UrlRequest extends Request
{
        /**
         * Rules for a url link
         *
         * @var array
         */
        protected static $rules = [
            'url' => 'required|url|unique:links,url',
            'hash' => 'required|unique:links,hash'
        ];
}
