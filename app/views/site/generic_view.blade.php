<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h5>Your Deployments:</h5>
		</div>
	</div>
</div>

<div class="media-block">
	<ul class="list-group">
		@if(!empty($deployments)) 
			@foreach ($deployments as $deployment)
				
					<?php $result = json_decode($deployment->wsResults); 
						if(empty($result)) 
						{
							$result = new stdClass();
							$result ->instance_id = '';
						}
						
						
					?>
		  			<li class="list-group-item">
						<div class="media">
							<p>
								<a alt="{{ $deployment->accountName }}" title="{{ $deployment->accountName }}" href="{{ URL::to('account/'.$deployment->cloudAccountId.'/edit') }}" class="pull-left" href="#">
								    <img title="{{ $deployment->accountName }}" class="media-object img-responsive" src="{{ asset('/assets/img/providers/'.Config::get('provider_meta.'.$deployment->cloudProvider.'.logo')) }}" alt="{{ $deployment->accountName }}" />
								</a> 
							</p>
							<form class="pull-right" method="post" action="{{ URL::to('deployment/' . $deployment->id . '/refresh') }}">
								<!-- CSRF Token -->
								<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
								<!-- ./ csrf token -->
								<button type="submit" class="btn btn-success pull-right" role="button"><span class="glyphicon glyphicon-refresh"></span></button>
							</form>
							<form class="pull-right" method="post" action="{{ URL::to('deployment/' . $deployment->id . '/delete') }}">
								<!-- CSRF Token -->
								<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
								<input type="hidden" name="instanceAction" value="terminate" />
								<input type="hidden" name="instanceID" value="{{{ $result->instance_id }}}" />
								<!-- ./ csrf token -->
								<button type="submit" class="btn btn-danger pull-right" role="button"><span class="glyphicon glyphicon-trash"></span></button>
							</form>
							<div class="media-body">
								
								<h4 class="media-heading">{{ String::title($deployment->name) }} </h4>
								<p>
									<?php 
									$url = URL::to('deployment/'.$deployment->id.'/instanceAction');
									$downloadUrl = URL::to('deployment/'.$deployment->id.'/downloadKey');
									$logUrl = URL::to('deployment/'.$deployment->id.'/log');
									if(in_array($deployment->status, array('Completed', 'start', 'stop')))
										{
											$anchor = '<a target="_blank" href="'.xDockerEngine::getProtocol($deployment->docker_name). $result->public_dns .xDockerEngine::urlAppend($deployment->docker_name).'">'.xDockerEngine::getDisplayName($deployment->docker_name).'</a>';
											echo $result->instance_id .CloudProvider::getState($deployment->cloudAccountId, $result->instance_id) .' | '.xDockerEngine::getDockerUrl($deployment->docker_name) . ' | ' .$anchor . ' | '  .xDockerEngine::documentationUrl($deployment->docker_name) 
											.' | <a title="Support" alt="Support" class="glyphicon glyphicon-envelope" href="mailto:support@xervmon.com"></a>'
											.' | <a title="Contact Xervmon to manage this" alt="Contact Xervmon to manage this" href="mailto:support@xervmon.com"><img src="'.asset('assets/ico/favicon.ico').'"/></a>'
									
											
											//'<a title="Start" href="#" onclick="start(\''.$url.'\',\''.$result->instance_id.'\', \''.csrf_token().'\')"><span class="glyphicon glyphicon-collapse-up"> </span></a> | '  .
											//'<a title="Stop" href="#" onclick="stop(\''.$url.'\',\''.$result->instance_id.'\', \''.csrf_token().'\')"><span class="glyphicon glyphicon-collapse-down"> </span></a> | '.
											. ' | <a title="Download" href="#" onclick="downloadKey(\''.$downloadUrl.'\',\''.$result->instance_id.'\', \''.csrf_token().'\')"><span class="glyphicon glyphicon-cloud-download"> </span> Pem </a>'
											. ' | <a title="ViewLog" href="'.$logUrl.'" ><span class="glyphicon glyphicon-th-list"> </span>  </a>';
																					
										}
									else 
									{
										echo  xDockerEngine::getDockerUrl($deployment->docker_name) . ' | ' .xDockerEngine::getDisplayName($deployment->docker_name) . ' | ' .xDockerEngine::documentationUrl($deployment->docker_name).
										' | <a title="Support" alt="Support" class="glyphicon glyphicon-envelope" href="mailto:support@xervmon.com"></a>'
										.' | <a title="Contact Xervmon to manage this" alt="Contact Xervmon to manage this" href="mailto:support@xervmon.com"><img src="'.asset('assets/ico/favicon.ico').'"/></a>'
										. ' | <a title="Download" href="#" onclick="downloadKey(\''.$downloadUrl.'\',\''.$result->instance_id.'\', \''.csrf_token().'\')"><span class="glyphicon glyphicon-cloud-download"> </span> Pem </a>'
										. ' | <a title="ViewLog" href="'.$logUrl.'" ><span class="glyphicon glyphicon-th-list"> </span>  </a>';
									}
									?>
									
								</p>
								<p>
									
									{{UIHelper::getDataOrganized($deployment->parameters)}}
									
								</p>
								<p>
									@if($deployment->status == 'Completed' && isset($result->public_dns))
										{{UIHelper::getContainer(RemoteAPI::Containers($result->public_dns))}}
									@endif
								</p>
			
								<p>
									<span title="Created At"><span class="glyphicon glyphicon-calendar"></span> <strong>Build Date</strong>:{{{ $deployment->created_at }}}</span>
								</p>
								<p>
									
									<span title="Status">{{ UIHelper::getLabel($deployment->status) }}</span>
								</p>
							</div>
						</div>
					</li>	
			@endforeach
		@endif
	</ul>
	@if(empty($deployments) || count($deployments) === 0) 
		<div class="alert alert-info"> {{{ Lang::get('deployment/deployment.empty_deployments') }}}</div>
	@endif
</div>

<!--
<a href="{{ URL::to('deployment/create') }}" class="btn btn-primary pull-right" role="button">Add New Deployment</a>
-->
<div class="page-header">
	<div class="row">
		<div class="col-md-9">
			<h5>Public Docker Images:</h5>
		</div>
		<div class="col-md-3">
			<form class="navbar-right" action="#" role="search" method="get">
                <div class="form-group home-search">
                  <div class="input-group">
                    <input class="form-control" name="q" type="search" placeholder="Search" value="{{$search_term}}">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-inverse" title="Search"><span class="fa fa-search"></span></button>
                    </span>
                  </div>
                </div>
            </form>
		</div>
	</div>
</div>
<p>
</p>
<div class="media-block">
	<ul class="list-group list-group-custom">
		@if(!empty($dockerInstances))
			@foreach($dockerInstances as $instance)
				@if(xDockerEngine::enabled($instance->name))
		  			<li class="list-group-item">
		  			<!--[is_automated] => 1
		            [name] => vubui/ubuntu
		            [is_trusted] => 1
		            [is_official] => 
		            [star_count] => 0
		            [description] => -->
					<div class="media">
						<span class="pull-left" href="#">
							<img style="width:25px;height:25px" class="media-object img-responsive" src="{{ asset('/assets/img/providers/'.xDockerEngine::getLogo($instance -> name)) }}" alt="{{ $instance -> name }}" />
						</span>
						<a href="{{ URL::to('deployment/create/') }}?name={{urlencode($instance -> name)}}" class="btn btn-primary pull-right" role="button"><span class="glyphicon glyphicon-play"></span></a>
						<div class="media-body">
							<h4 class="media-heading">{{!empty($instance -> name)?xDockerEngine::getDockerUrl($instance->name).' ' .$instance->name:''}}</h4>
						    <p>
						    	{{{!empty($instance -> description) ? $instance -> description:''}}}
							</p>
							<p>
						    	{{{!empty($instance -> is_automated)?$instance -> is_automated:'Not Automated'}}}
						    	|
						    	{{{!empty($instance -> is_trusted)?$instance -> is_trusted:'Not Trusted'}}}
						    	|
						    	{{{!empty($instance -> is_official)?$instance -> is_official:'Not Official'}}}
						    	|
						    	{{{!empty($instance -> star_count)?$instance -> star_count:'0'}}}
						    	|
						    	{{xDockerEngine::documentationUrl($instance->name)}}
						    	|
						    	<a title="Support" alt="Support" class="glyphicon glyphicon-envelope" href="mailto:support@xervmon.com"></a>'
								| 
								<a title="Contact Xervmon to manage this" alt="Contact Xervmon to manage this" href="mailto:support@xervmon.com"><img src="{{{ asset('assets/ico/favicon.ico') }}}"/></a>
									
						    	
							</p>
						</div>
					</div>
				</li>
				@endif
			@endforeach
		@endif
	</ul>
	<!-- <div class="text-center">
		<div class="pagination">
			<ul>
	        	<li class="previous"><a href="#fakelink" class="fui-arrow-left"></a></li>
	            <li class="active"><a href="#fakelink">1</a></li>
	            <li><a href="#fakelink">2</a></li>
	            <li><a href="#fakelink">3</a></li>
	            <li><a href="#fakelink">4</a></li>
	            <li><a href="#fakelink">5</a></li>
	            <li><a href="#fakelink">6</a></li>
	            <li><a href="#fakelink">7</a></li>
	            <li><a href="#fakelink">8</a></li>
	            <li class="next"><a href="#fakelink" class="fui-arrow-right"></a></li>
			</ul>
		</div>
	</div> -->
</div>
<script src="{{asset('assets/js/deployment.js')}}"></script>
