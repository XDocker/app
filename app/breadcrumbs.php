<?php

Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.home'), function ($breadcrumbs) {
	$breadcrumbs->push(ucfirst(Lang::get('breadcrumb/breadcrumb.home')), URL::to('/'));
});

Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.account'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(ucfirst(Lang::get('breadcrumb/breadcrumb.account')), URL::to('account/'));
});
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.CreateAccount'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.account'));
	// $breadcrumbs->push('Account', URL::to('account/'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.CreateAccount'), URL::to('account/create'));
});

Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.deployment'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(ucfirst(Lang::get('breadcrumb/breadcrumb.deployment')), URL::to('deployment/'));
});
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.CreateDeployment'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.account'));
	// $breadcrumbs->push('Account', URL::to('account/'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.CreateDeployment'), URL::to('deployment/create'));
});

Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.EditAccount'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.account'));
	// $breadcrumbs->push('Account', URL::to('account/'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.EditAccount'), URL::to('account/{account}/edit'));
});

Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.EngineLog'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.EngineLog'), URL::to('enginelog/'));
});

Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.ServiceStatus'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.ServiceStatus'), URL::to('ServiceStatus/'));
});

Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.Ticket'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.Ticket'), URL::to('ticket/'));
});
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.AddTicket'), function ($breadcrumbs) {
	// $breadcrumbs->parent('home');
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.Ticket'), URL::to('ticket/'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.AddTicket'), URL::to('ticket/create'));
});
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.DataSecurity'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.DataSecurity'), URL::to('data-security'));

});
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.Roadmap'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.Roadmap'), URL::to('roadmap'));

});
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.DevOps'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.DevOps'), URL::to('DevOps'));

});
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.Videos'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.Videos'), URL::to('Videos'));

});
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.CloudExperts'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.CloudExperts'), URL::to('cloudExperts'));

});
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.accountContainer'), function ($breadcrumbs,$id) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.account'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.accountContainer'), URL::to('account/docker/'.$id.'/Containers'));

});

Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.deploymentContainer'), function ($breadcrumbs,$id) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.deployment'));
	$breadcrumbs->push(ucfirst(Lang::get('breadcrumb/breadcrumb.deploymentContainer')), URL::to('deployment/docker/'.$id.'/Containers'));

});


Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.accountTop'), function ($breadcrumbs,$id) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.accountContainer'),$id);
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.accountTop'), URL::to('account/create'));
});

Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.deploymentTop'), function ($breadcrumbs,$id) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.deploymentContainer'),$id);
	$breadcrumbs->push(ucfirst(Lang::get('breadcrumb/breadcrumb.deploymentTop')), URL::to('account/create'));
});

