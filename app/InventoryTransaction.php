<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    //
    public function inventoriesData()
    {
        return $this->belongsTo(Inventory::class,'inventory_id','id');
    }
}
