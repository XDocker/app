<?php
/**
* Class and Function List:
* Function list:
* - author()
* Classes list:
* - Test extends \
*/
class Test extends \Eloquent 
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
