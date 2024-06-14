@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
  @include('includes.flash-message')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> {{ $title }} : {{ $role->name }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route($module.'.index') }}">{{ $title }}</a></li>
            <li class="breadcrumb-item active">Update Permissions</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="card">
          <div class="card-header">
            <div class="col-1 float-right">
              <a href="{{ route($module.'.index') }}" class="btn btn-block btn-danger ">Back</a>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card-body">
              {!! Form::model($role, ['method' => 'PUT','route' => [$module.'.addPermissionToRole', $role->id],'class'=>'validate','files'=>false]) !!}
              
              <div class="row">
                <div class="col">
                  @foreach ($permissions as $permission)
                    <label>
                      {!! Form::checkbox('permission[]',$permission->name, in_array($permission->id, $rolePermissions) ? 'checked':'',['placeholder' => 'Name', 'required'=>true, 'class'=>'ml-4']) !!} 
                        {{ $permission->name }}
                    </label>
                  @endforeach
                </div>
              </div>
              @if(count($permissions)>0)
              <div class="col-sm-6">
                <div class="card-footer">
                  <a href="{{ route($module.'.addPermissionToRole',$role->id) }}" class="btn btn-default">Cancel</a>
                  <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
              </div>
              @endif
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection