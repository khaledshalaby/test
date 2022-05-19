<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory , SoftDeletes;
    protected $primarykey  = 'id';
    protected $table = 'suppliers' ;
    protected $fillable = ['name','cat_id','phone','address','pharamcy_code'];
    protected $hidden = ['created_at','updated_at'];

    public function cat()
    {
        return $this->belongsTo('App\Models\SupplierClassification');
    }
}
