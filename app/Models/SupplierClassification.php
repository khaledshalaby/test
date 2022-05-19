<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierClassification extends Model
{
    use HasFactory , SoftDeletes;
    protected $primarykey  = 'id';
    protected $table = 'supplier_classifications' ;
    protected $fillable = ['name'];
    protected $hidden = ['created_at','updated_at'];
}
