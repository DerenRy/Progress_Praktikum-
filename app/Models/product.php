<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'unit',
        'type',
        'information',
        'qty',
        'producer',
        'supplier_id'
    ];

    public function supplier(){
        return $this->belongsTo(supplier::class);
    }
}
