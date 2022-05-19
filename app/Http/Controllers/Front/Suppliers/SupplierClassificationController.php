<?php

namespace App\Http\Controllers\Front\Suppliers;
use App\Http\Controllers\Controller;

use App\Models\SupplierClassification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class SupplierClassificationController extends Controller
{
    public function __construct(){

        $this->model="App\Models\SupplierClassification";
    }


    public function index()
    {
        $supplierclassification = $this->model::all();
        return view('suppliers.supplier-classification',compact('supplierclassification'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules =
        [
            'name'=>'required|unique:supplier_classifications',
        ];

        $messages =
        [
            "name.require" =>"هذا الحقل مطلوب",
            "name.unique" => "هذا الاسم موجود بالفعل "
        ];
        $valid = Validator::make(request()->all(),$rules,$messages);
        if ($valid->fails())
        {
            $errors = $valid->errors();
            session()->flash('Error',$errors->first());
            return redirect('/supplier-classification');
        }else{
            $data=$valid->validated();
            $this->model::create($data);
            session()->flash('Add',  __('messages.add_success'));
            return redirect('/supplier-classification');
        }
    }


    public function show(SupplierClassification $supplierClassification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierClassification  $supplierClassification
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierClassification $supplierClassification)
    {
        //
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $rules =
        [
            'id'=>'required|exists:supplier_classifications,id',
            'name'=>'sometimes|nullable|unique:supplier_classifications,name,'.$id,

        ];

        $messages =
        [
            "name.unique" => "هذا الاسم موجود بالفعل ",

        ];
        $valid = Validator::make(request()->all(),$rules,$messages);

        if ($valid->fails())
        {
            $errors = $valid->errors();
            session()->flash('Error',$errors->first());
            return redirect('/supplier-classification');
        }
        else{
            $data=$valid->validated();
            unset($data['id']);
            $this->model::where('id','=',$request->id)->update($data);
            session()->flash('Edit', __('messages.edit_success'));
            return redirect('/supplier-classification');
        }
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $this->model::find($id)->delete();
        session()->flash('delete', __('messages.delete_success'));
        return redirect('/supplier-classification');
    }
}
