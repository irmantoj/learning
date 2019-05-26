<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Category;

class Category extends Model
{
    protected $guarded = [];

    public function parts() {
      return $this->hasMany(Part::class, "category_id");
    }
}
