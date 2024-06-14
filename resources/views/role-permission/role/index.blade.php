@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
   @include('includes.flash-message')
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>{{ $title }}</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route($module.'.index') }}">{{ $title }}</a></li>
                  <li class="breadcrumb-item active">Listing</li>
               </ol>
            </div>
         </div>
      </div>
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header">
                     <div class="col-1 float-right">
                        <a href="{{ route($module.'.create') }}" class="btn btn-block btn-primary ">Add</a>
                     </div>
                  </div>
                  <div class="card-body">
                     <table id="listDataTable" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>Name</th>
                              <th>Created at</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if(Count($data) >0)
                           @foreach ($data as $list)
                           <tr>
                              <td>{{ $list->name }}</td>
                              <td>{{ dynamicDateFormat($list->created_at,'d-m-Y H:i A') }}</td>
                              <td>
                                 {!! getActionButtons([['key'=>'edit','url'=>route($module.'.edit',$list->id)]]) !!}
                                 {!! getActionButtons([['key'=>'delete','url'=>route($module.'.delete',$list->id)]]) !!}
                                 {!! getActionButtons([['key'=>'permission','url'=>route($module.'.addPermissionToRole',$list->id)]]) !!}
                              </td>
                           </tr>
                           @endforeach
                           @endif
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<script>
   $( document ).ready(function() {
       $(function () {
       $("#listDataTable").DataTable({
           "responsive": true, "lengthChange": false, "autoWidth": false,
           "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
       }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
       
       });
   });
</script>
@endsection