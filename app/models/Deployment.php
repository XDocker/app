<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Deployment extends \Eloquent {
	use SoftDeletingTrait;
    protected $fillable = [];
	protected $softDelete = true;
}