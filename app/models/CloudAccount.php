<?php
/**
* Class and Function List:
* Function list:
* - author()
* Classes list:
* - CloudAccount extends \
*/
class CloudAccount extends \Eloquent 
{
    protected $fillable = [];
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
