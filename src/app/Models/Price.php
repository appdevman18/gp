<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'value',
        'product_id',
    ];
    
    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];

    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
