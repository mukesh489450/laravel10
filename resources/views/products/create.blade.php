@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
  @include('includes.flash-message')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add {{ $title }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route($module.'.index') }}">{{ $title }}</a></li>
            <li class="breadcrumb-item active">Add</li>
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
              {!! Form::open(['route' => "$module.store",'autocomplete'=>'off','class'=>'validate', 'files'=>false]) !!}
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Category</label>
                    {!! Form::select('category_id',$categories, null,['placeholder' => 'Select','id'=>'product_id', 'class'=>'form-control select2','required'=>true]) !!}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Name</label>
                    {!! Form::text('name',null, ['placeholder' => 'Name', 'required'=>true, 'class'=>'form-control']) !!} 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Price</label>
                    {!! Form::text('price', null,['placeholder' => 'Price', 'class'=>'form-control','required'=>true]) !!}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Description</label>
                    {!! Form::textarea('description',null, ['placeholder' => 'Description', 'required'=>true, 'class'=>'form-control h-134px', 'id'=>'description']) !!} 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Image</label>
                    {!! Form::file('image', ['class' => 'form-control', 'required' => true]) !!} 
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card-footer">
                  <a href="{{ route($module.'.create') }}" class="btn btn-default">Cancel</a>
                  <button type="submit" class="btn btn-info float-right">Submit</button>
                </div>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection