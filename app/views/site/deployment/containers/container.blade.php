@extends('site.layouts.default')

{{-- Content --}}
@section('content')


{{-- Content --}}
@section('content')
@section('breadcrumbs', Breadcrumbs::render(Lang::get('breadcrumb/breadcrumb.Container')))



<?php  foreach ($containers as $container) {

$getid['id'] = $container -> getId();
$runtimeInformations = $container -> getRuntimeInformations();
$contents[] = array_merge($getid,$runtimeInformations);
}?>



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
				<h4> Deployment Name:{{ $deployment->name }}</h4>
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
            {{ 'Name:' .$value['Name'].' '}}  </a>
            @if($value['State']['Running']==1)
            <button type="button" class="btn btn-success btn-xs" disabled="disabled">{{ 'Running' }}</button>
            <a href="#"><i class="fa fa-stop"></i></a>
            @else
            <button type="button" class="btn btn-danger btn-xs" disabled="disabled">{{ 'Stoped' }}</button>
            <a href="#"><i class="fa fa-play"></i></a>
            @endif
       <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
      </h4>
    </div>
    <div id="collapse{{ $key }}" class="panel-collapse collapse">
      <div class="panel-body">

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
         <?php foreach ($value['Config']['Env'] as $v3) {
              $env[] = explode('=',$v3); 
         } 
         $env_count= count($env); 
         $i=0;?>
         <thead>
           <tr>
              @foreach ($env as $v4)
                  <th> {{ $v4[0] }} </th> 
              @endforeach 
          </tr>
        </thead>
           
        <tbody>
          <tr>
               @foreach ($env as $v4)
                  <td> {{ $v4[1] }} </td> 
              @endforeach 
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
                      <li>{{ $k5.'='.json_encode($v5) }}</li>
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
                      <li>{{ $k6.'='.json_encode($v6) }}</li>
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
