<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCategories extends Model
{
    protected $table = 'item_categories';

    public function categoryName() {
        return $this->hasOne('App\Categories', 'id', 'categoryID');
    }
}
