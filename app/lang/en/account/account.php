<?php 

return array(

	/*
	|--------------------------------------------------------------------------
	| User Language Lines
	|--------------------------------------------------------------------------
	|
	|
	*/

	'cp_amazon_aws'            => 'Amazon AWS',
	'account_updated'          => 'Account updated. Now you can  <a href="'.URL::to('deployment').'">Deploy</a> your favorite docker image.',
	'account_created'          => 'Account created.',
	'add_account'			   => 'Add Account',
	'your_accounts'			   => 'Your Accounts:',
	'account_auth_failed'	   => 'Account authentication failed. Please check the credentials provided for the selected cloud provider.',
	'empty_accounts'  		   => 'You do not have any accounts. Create one by clicking on "Add Account" below',
	'deployment.account_required'  => 'To deploy, please create <a href="'.URL::to('account/create').'">Account</a> first',
     'account_delete'           =>   'Are You Sure  Want To Delete This Account ?. This would also Delete PORT PREFERENCES Associated with this Account.',
     'deployment_status_failed' => 'Deployment Status could not be updated now. Please try later.'
);