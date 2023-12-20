<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function prices(){
        return $this->hasMany(Price::class);
    }

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function quantityUnit(){
        return $this->hasOne(QuantityUnit::class, 'id', 'quantity_unit_id');
    }

    public function provider(){
        return $this->hasOne(Contact::class, 'id', 'provider_id');
    }

    public function brand(){
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

}
