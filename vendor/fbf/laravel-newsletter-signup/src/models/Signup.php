<?php namespace Fbf\LaravelNewsletterSignup;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Signup extends \Eloquent {

	use SoftDeletingTrait;
	protected $table = 'fbf_newsletter_signups';

	protected $softDelete = true;
	protected $dates = ['deleted_at'];

}