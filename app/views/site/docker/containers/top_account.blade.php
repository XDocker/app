@extends('site.layouts.default')

{{-- Content --}}
@section('content')
@section('breadcrumbs', Breadcrumbs::render(Lang::get('breadcrumb/breadcrumb.accountTop'),$account->id))

  <div class="page-header">
    <div class="row">
      <div class="col-md-9">
        <h4> Account Name:{{ $account->name }}</h4>
      </div>
    </div>
  </div>


 <div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">

      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            @foreach($accountTopkey as $key)
              <th> {{ $key }} </th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach($accountTop as $keyval)
          <tr class="active">
             @foreach($keyval as $val)
                <td> {{ $val }} </td>
             @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>     

    </div>
  </div>
</div>         



  @stop
