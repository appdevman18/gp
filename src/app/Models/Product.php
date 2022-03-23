<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'url',
        'title',
        'store',
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_products');
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function getMyProducts()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products()->orderBy('created_at', 'desc')->simplePaginate(20);

        return $products;
    }

    public function getAllStores()
    {
        $stores = $this->pluck('store')->toArray();

        return $stores;
    }

    public function getAllProducts()
    {
        $products = Product::with('prices')->orderBy('created_at', 'desc')->simplePaginate(20);

        return $products;
    }

    public function follow()
    {
        $this->users()->attach(auth()->user()->id);

        return $this;
    }

    public function unFollow()
    {
        $this->users()->detach(auth()->user()->id);

        return $this;
    }

    public function isFollow()
    {
        return $this->users()->where('user_id', auth()->user()->id)->first(['id']);
    }

}
