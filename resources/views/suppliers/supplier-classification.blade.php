@extends('layouts.master')
@section('title')
{{__('messages.supplier_classification')}}
@endsection
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('messages.suppliers')}} </h4><span
                class="text-muted mt-1 tx-13 mr-2 mb-0"> / {{__('messages.supplier_classification')}}</span>
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
                    <h4 class="card-title mg-b-0">{{__('messages.supplier_classification')}}</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div class='row mb-4'>
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#add_classification">{{__('messages.add_classification')}}</a>
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
                                <th class="border-bottom-0">{{__('messages.classification_name') }}</th>
                                <th class="border-bottom-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($supplierclassification as $sp_ca)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$sp_ca->name}}</td>
                                <td>
                                    <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                        data-id="{{ $sp_ca->id }}" data-name="{{ $sp_ca->name }}"
                                        data-toggle="modal" href="#edit_classification" title="{{__('messages.edit')}}"><i
                                            class="las la-pen"></i></a>

                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                        data-id="{{ $sp_ca->id }}" data-name="{{ $sp_ca->name }}" data-toggle="modal"
                                        href="#delete_classification" title="حذف"><i class="las la-trash"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Add Classification -->
                <div class="modal" id="add_classification">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">{{__('messages.add_classification')}}</h6><button
                                    aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>

                            <form action="{{route('supplier-classification.store')}}" method='POST'>
                                {{csrf_field()}}
                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="name" class="col-form-label text-md-end">{{
                                            __('messages.classification_name') }}</label>
                                        <input type='text' class='form-control' id='name' name='name'
                                            placeholder='{{__('messages.classification_name') }}'
                                            required>
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
                <div class="modal fade" id="edit_classification" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.edit_classification')}}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="supplier-classification/update" method="post" autocomplete="off">
                                {{method_field('patch')}}
                                {{csrf_field()}}
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="id" value="">
                                    <div class="form-group mb-3">
                                        <label for="name" class="col-form-label text-md-end">{{
                                            __('messages.classification_name') }}</label>
                                        <input type='text' class='form-control' id='name' name='name'
                                            placeholder='{{__('messages.classification_name') }}' required>
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
                <div class="modal fade" id="delete_classification" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.delete_classification')}}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="supplier-classification/destroy" method="post" autocomplete="off">
                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <div class="modal-body">
                                    <p>{{__('messages.confirm_delete')}}</p><br>
                                    <input type="hidden" name="id" id="id" value="">
                                    <input class="form-control" name="classification_name" id="classification_name"
                                        type="text" readonly>
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
    $('#edit_classification').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    })

    $('#delete_classification').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var classification_name = button.data('name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #classification_name').val(classification_name);
    })
</script>
@endsection
