@extends('layouts.master')
@section('title')
{{__('messages.suppliers')}}
@endsection
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('messages.suppliers')}} </h4><span
                class="text-muted mt-1 tx-13 mr-2 mb-0"> / {{__('messages.suppliers')}}</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('Error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Error') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session()->has('delete'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session()->has('Edit'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Edit') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- row -->
<div class="row">
    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0 ">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">{{__('messages.suppliers')}}</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div class='row mb-4'>
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#add_supplier">{{__('messages.add_supplier')}}</a>
                    </div>
                </div>
                <div class="table-responsive ">
                    <div id='table_buttons' class='row mb-2'>
                        <div class="col-md-12">

                        </div>
                    </div>
                    <table id="example_ace" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">{{__('messages.supplier_classification') }}</th>
                                <th class="border-bottom-0">{{__('messages.supplier_name') }}</th>
                                <th class="border-bottom-0">{{__('messages.pharamcy_code') }} </th>
                                <th class="border-bottom-0">{{__('messages.phone') }}</th>
                                <th class="border-bottom-0">{{__('messages.address') }}</th>
                                <th class="border-bottom-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suppliers as $sp)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$sp->cat->name}}</td>
                                <td>{{$sp->name}}</td>
                                <td>{{$sp->pharamcy_code}}</td>
                                <td>{{$sp->phone}}</td>
                                <td>{{$sp->address}}</td>
                                <td>
                                    <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                        data-id="{{ $sp->id }}" data-name="{{ $sp->name }}"
                                        data-pharamcy_code="{{ $sp->pharamcy_code }}" data-phone="{{ $sp->phone }}"
                                        data-address="{{ $sp->address }}" data-cat_id = '{{$sp->cat_id}}'data-toggle="modal" href="#edit_supplier"
                                        title="{{__('messages.edit')}}"><i class="las la-pen"></i></a>

                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                        data-id="{{ $sp->id }}" data-name="{{ $sp->name }}" data-toggle="modal"
                                        href="#delete_supplier" title="حذف"><i class="las la-trash"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Add Classification -->
                <div class="modal" id="add_supplier">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">{{__('messages.add_supplier')}}</h6><button aria-label="Close"
                                    class="close" data-dismiss="modal" type="button"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>

                            <form action="{{route('suppliers.store')}}" method='POST'>
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="cat_id" class="col-form-label text-md-end">{{__('messages.supplier_classification') }}</label>
                                        <select  class='form-control' id='cat_id' name='cat_id'  required>
                                            <option value="" selected disabled>-- {{__('messages.supplier_classification') }} --</option>
                                            @foreach($classifications as $cat)
                                                <option value = '{{$cat->id}}'>{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name" class="col-form-label text-md-end">{{
                                            __('messages.supplier_name') }}</label>
                                        <input type='text' class='form-control' id='name' name='name'
                                            placeholder='{{__('messages.supplier_name') }}' required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="pharamcy_code" class="col-form-label text-md-end">{{
                                            __('messages.pharamcy_code') }}</label>
                                        <input type='text' class='form-control' id='pharamcy_code' name='pharamcy_code'
                                            placeholder='{{__('messages.pharamcy_code') }}' >
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="phone" class="col-form-label text-md-end">{{
                                            __('messages.phone') }}</label>
                                        <input type='text' class='form-control' id='phone' name='phone'
                                        pattern="[0-9]{1,}" title="please enter number only"
                                        placeholder='{{__('messages.phone') }}' >
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address" class="col-form-label text-md-end">{{
                                            __('messages.address') }}</label>
                                        <input type='text' class='form-control' id='address' name='address'
                                            placeholder='{{__('messages.address') }}' >
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-primary" type="submit">{{__('messages.add')}}</button>
                                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                                        type="button">{{__('messages.close')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END -->

                <!-- Edit Classification -->
                <div class="modal fade" id="edit_supplier" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.edit_supplier')}}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="suppliers/update" method="post" autocomplete="off">
                                {{method_field('patch')}}
                                {{csrf_field()}}
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="id" value="">
                                    <div class="form-group mb-3">
                                        <label for="cat_id" class="col-form-label text-md-end">{{__('messages.supplier_classification') }}</label>
                                        <select  class='form-control' id='cat_id' name='cat_id'  required>
                                            <option value="" selected disabled>-- {{__('messages.supplier_classification') }} --</option>
                                            @foreach($classifications as $cat)
                                                <option value = '{{$cat->id}}'>{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name" class="col-form-label text-md-end">{{
                                            __('messages.supplier_name') }}</label>
                                        <input type='text' class='form-control' id='name' name='name'
                                            placeholder='{{__('messages.supplier_name') }}' required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="pharamcy_code" class="col-form-label text-md-end">{{
                                            __('messages.pharamcy_code') }}</label>
                                        <input type='text' class='form-control' id='pharamcy_code' name='pharamcy_code'
                                            placeholder='{{__('messages.pharamcy_code') }}' >
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="phone" class="col-form-label text-md-end">{{
                                            __('messages.phone') }}</label>
                                        <input type='text' class='form-control' id='phone' name='phone'
                                        pattern="[0-9]{1,}" title="please enter number only"
                                            placeholder='{{__('messages.phone') }}' >
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address" class="col-form-label text-md-end">{{
                                            __('messages.address') }}</label>
                                        <input type='text' class='form-control' id='address' name='address'
                                            placeholder='{{__('messages.address') }}' >
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">{{__('messages.edit')}}</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{__('messages.close')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END -->

                <!-- Delete Classification -->
                <div class="modal fade" id="delete_supplier" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.delete_supplier')}}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="suppliers/destroy" method="post" autocomplete="off">
                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <div class="modal-body">
                                    <p>{{__('messages.confirm_delete')}}</p><br>
                                    <input type="hidden" name="id" id="id" value="">
                                    <input class="form-control" name="name" id="name" type="text" readonly>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">{{__('messages.delete')}}</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{__('messages.close')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END -->

            </div>
        </div>
    </div>
    <!--/div-->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<script>
    $('#edit_supplier').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var cat_id = button.data('cat_id')
        var name = button.data('name')
        var phone = button.data('phone')
        var address = button.data('address')
        var pharamcy_code = button.data('pharamcy_code')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #cat_id').val(cat_id);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #phone').val(phone);
        modal.find('.modal-body #address').val(address);
        modal.find('.modal-body #pharamcy_code').val(pharamcy_code);
    })

    $('#delete_supplier').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    })
</script>
@endsection
