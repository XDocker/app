@extends('site.layouts.default')

{{-- Content --}}
@section('content')


{{-- Content --}}
@section('content')
@section('breadcrumbs', Breadcrumbs::render(Lang::get('breadcrumb/breadcrumb.accountContainer'),$account->id))

<?php  

	if(empty($containers))
	{
		$contents = json_decode($account->containers, true);	
	}
	else 
	{
		$contents = $containers;
		/*foreach ($containers as $container) 
		{
			$getid['id'] = $container -> getId();
			$runtimeInformations = $container -> getRuntimeInformations();
			$contents[] = array_merge($getid,$runtimeInformations);
		}*/
	}
	
?>



<script type="text/javascript">
function toggleChevron(e) {
    $(e.target)
        .prev('.panel-heading')
        .find("i.indicator")
        .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
}
$('#accordion').on('hidden.bs.collapse', toggleChevron);
$('#accordion').on('shown.bs.collapse', toggleChevron);
</script>

<div class="page-header">
		<div class="row">
			<div class="col-md-9">
				<h4> Account Name:{{ $account->name }}</h4>
			</div>
		</div>
	</div>


<div class="container">
	<div class="row clearfix">

	<div class="panel-group" id="accordion">


@foreach ($contents as $key=>$value)

<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key }}">
            {{ 'Name:' .$account->name }}  </a>
            @if($status==1)
            <button type="button" class="btn btn-success btn-xs" disabled="disabled">{{ 'Running' }}</button>
            <a href="{{URL::to('account/docker/container/stop').'?id='.$value['Id'].'&accountId=' .$account->id }}"><i class="fa fa-stop"></i></a>
           
            @else
            <button type="button" class="btn btn-danger btn-xs" disabled="disabled">{{ 'Stopped' }}</button>
            <a href="{{URL::to('account/docker/container/start').'?id='.$value['Id'].'&accountId=' .$account->id }}"><i class="fa fa-play"></i></a>
            @endif
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key }}">
       <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i></a>
      </h4>
    </div>
    <div id="collapse{{ $key }}" class="panel-collapse collapse">
      <div class="panel-body">
		<a class="btn btn-info btn-xs" href="{{URL::to('account/docker/container/top').'?id='.$value['Id'].'&accountId=' .$account->id }}">{{ 'Top' }}</i></a>
           
     <table class="table table-bordered">
        <thead>
          <tr>
            <th> {{ Lang::get('deployment/deployment.Hostname') }} </th> 
            <th> {{ Lang::get('deployment/deployment.Image')     }} </th>
            <th> {{ Lang::get('deployment/deployment.Memory')    }} </th>
            <th> {{ Lang::get('deployment/deployment.Cmd')       }} </th>
          </tr>
        </thead>
        <tbody>
          <tr>
               
            <td> {{ $value['Config']['Hostname']     }} </td>
            <td> {{ $value['Config']['Image']     }} </td>
            <td> {{ $value['Config']['Memory']     }} </td>
            <td> @if(is_array($value['Config']['Cmd'])) 
              <ul>
                    @foreach ($value['Config']['Cmd'] as $v2)
                      <li>{{ $v2 }}</li>
                    @endforeach
              </ul>      
                 @endif  
            </td>
   
          </tr> 
      </tbody>
      </table>

	
     <table class="table table-bordered">
        <thead>
          <tr>
            <th> {{ Lang::get('deployment/deployment.Driver') }} </th> 
            <th> {{ Lang::get('deployment/deployment.ExecDriver')     }} </th>
            <th> {{ Lang::get('deployment/deployment.PortBindings')    }} </th>
            <th> {{ Lang::get('deployment/deployment.Created')       }} </th>
          </tr>
        </thead>
        <tbody>
          <tr>
               
            <td> {{ $value['Driver']   }} </td>
            <td> {{ $value['ExecDriver'] }} </td>
            
            <td> @if(is_array($value['HostConfig']['PortBindings'])) 
              <ul>
                    @foreach ($value['HostConfig']['PortBindings'] as $k5=>$v5)
                      <li>{{ preg_replace('/[^A-Za-z0-9 \-,:]/', '', str_replace('/', '-', $k5).' : '.json_encode($v5)) }}</li>
                    @endforeach
              </ul>      
                 @endif  
            </td>

            <td> {{ $value['Created'] }} </td>
   
          </tr> 
      </tbody>
      </table>


      <table class="table table-bordered">
        <thead>
          <tr>
             <th> {{ Lang::get('deployment/deployment.Bridge') }} </th> 
            <th> {{ Lang::get('deployment/deployment.Gateway')     }} </th>
            <th> {{ Lang::get('deployment/deployment.IPAddress')    }} </th>
            <th> {{ Lang::get('deployment/deployment.Ports')       }} </th>
          </tr>
        </thead>
        <tbody>
          <tr>
               
            <td> {{ $value['NetworkSettings']['Bridge']   }} </td>
            <td> {{ $value['NetworkSettings']['Gateway'] }} </td>            
            <td> {{ $value['NetworkSettings']['IPAddress'] }} </td>
            
            <td> @if(is_array($value['NetworkSettings']['Ports'])) 
              <ul>
                    @foreach ($value['NetworkSettings']['Ports'] as $k6=>$v6)
                      <li>{{ preg_replace('/[^A-Za-z0-9 \-,:]/', '', str_replace('/', '-', $k6).' : '.json_encode($v6)) }}</li>
                    @endforeach
              </ul>      
                 @endif  
            </td>

   
          </tr> 
      </tbody>
      </table>

  </div>
    </div>
  </div>
<?php unset($value) ?>
  @endforeach  
</div>


    </div> 
  </div>

  @stop
