<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Front\Suppliers;
use App\Http\Controllers\Controller;

use App\Models\Supplier;
use App\Models\SupplierClassification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->model = 'App\Models\Supplier';
    }
    public function index()
    {
        $suppliers = $this->model::all();
        $classifications = SupplierClassification::all();
        return view('suppliers.suppliers',compact('classifications','suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =
        [
            'name'=>'required|unique:suppliers,name',
            'phone'=>'sometimes|nullable|unique:suppliers,phone',
            'address'=>'sometimes|nullable',
            'cat_id'=>'required',
            'pharamcy_code'=>'required',
        ];

        $messages =
        [
            "name.require" =>"هذا الحقل مطلوب",
            "cat_id.require" =>"هذا الحقل مطلوب",
            "pharamcy_code.require" =>"هذا الحقل مطلوب",
            "name.unique" => " الاسم موجود بالفعل ",
            "phone.unique" => "رقم الرقم موجود بالفعل ",
        ];
        $valid = Validator::make(request()->all(),$rules,$messages);
        if ($valid->fails())
        {
            $errors = $valid->errors();
            session()->flash('Error',$errors->first());
            return redirect('/suppliers');
        }else{
            $data=$valid->validated();
            $this->model::create($data);
            session()->flash('Add',  __('messages.add_success'));
            return redirect('/suppliers');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Front\Suppliers\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Front\Suppliers\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Front\Suppliers\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $supplier =  $this->model::findOrFail($request->id);

        $rules =
        [
            'name'=>'required|unique:suppliers,name,'.$id,
            'phone'=>'sometimes|nullable|unique:suppliers,phone,'.$id,
            'address'=>'sometimes|nullable',
            'cat_id'=>'sometimes|nullable|',
            'pharamcy_code'=>'sometimes|nullable|',
        ];

        $messages =
        [
            "name.require" =>"هذا الحقل مطلوب",
            "cat_id.require" =>"هذا الحقل مطلوب",
            "pharamcy_code.require" =>"هذا الحقل مطلوب",
            "name.unique" => " الاسم موجود بالفعل ",
            "phone.unique" => "رقم الرقم موجود بالفعل ",
        ];
        if($supplier){
            $valid = Validator::make(request()->all(),$rules,$messages);
            if ($valid->fails())
            {
                $errors = $valid->errors();
                session()->flash('Error',$errors->first());
                return back();
            }else{
                $data=$valid->validated();
                $supplier->update($data);
                session()->flash('Edit',  __('messages.edit_success'));
                return back();
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Front\Suppliers\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $supplier =  $this->model::findOrFail($request->id);
        if($supplier->delete()){
            session()->flash('delete', __('messages.delete_success'));
        }

        return back();


    }
}
