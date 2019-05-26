<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    protected $guarded = [];

    public function categories () {

      return $this->hasMany(Category::class, "motorcycle_id");

    }

}
