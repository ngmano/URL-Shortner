<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Uuid;

class ShortenerUrl extends Model
{    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'original_url', 'shortener_url'
    ];   


    /**
	 *  Setup model event hooks
	 */
	public static function boot()
	{
	    parent::boot();
	    self::creating(function ($model) {
	    	$urlSorted = false;
	    	do {
    			$string = '';
			    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			    $max = strlen($characters) - 1;
			    
			    for ($i = 0; $i < 6; $i++) {
			        $string .= $characters[mt_rand(0, $max)];
			    }
			    
			    $isExists = self::where(['shortener_url' => $string])->first();		    
			    if(!$isExists) {
			        $urlSorted = true;
			    }
			} while($urlSorted = false);
	        $model->shortener_url = $string;
	    });
	}
}
