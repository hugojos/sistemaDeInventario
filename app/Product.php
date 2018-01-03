<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function Category(){
      return $this->hasOne(Category::class, 'id', 'category_id');
    }

    protected $fillable = [
      'name','price','category_id'
    ];
}
