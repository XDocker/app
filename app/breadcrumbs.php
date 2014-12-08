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
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.Reserved'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.ReservedInstancePricing'), URL::to('Reserved/'));
});
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.OndemandInstancePricing'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.OndemandInstancePricing'), URL::to('Ondemand/'));
});
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.EC2Products'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.EC2Products'), URL::to('EC2Products/'));
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
Breadcrumbs::register(Lang::get('breadcrumb/breadcrumb.CloudExperts'), function ($breadcrumbs) {
	$breadcrumbs->parent(Lang::get('breadcrumb/breadcrumb.home'));
	$breadcrumbs->push(Lang::get('breadcrumb/breadcrumb.CloudExperts'), URL::to('cloudExperts'));

});