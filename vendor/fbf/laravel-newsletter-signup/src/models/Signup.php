<?php namespace Fbf\LaravelNewsletterSignup;
	use SoftDeletingTrait;
class Signup extends \Eloquent {


	protected $table = 'fbf_newsletter_signups';

	protected $softDelete = true;
	protected $dates = ['deleted_at'];

}