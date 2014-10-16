<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
* Class and Function List:
* Function list:
* - author()
* Classes list:
* - CloudAccount extends \
*/
class CloudAccount extends \Eloquent 
{
	use SoftDeletingTrait;
    protected $fillable = [];
	protected $softDelete = true;
    /**
     * Get the account's owner.
     *
     * @return User
     */
    public function owner() 
    {
        return $this->belongsTo('User', 'user_id');
    }
}
