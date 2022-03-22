<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    public function inventories()
    {
        return $this->hasMany(InventoryTransaction::class);
    }
}
