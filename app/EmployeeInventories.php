<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeInventories extends Model
{
    //
    public function inventoryData()
    {
        return $this->belongsTo(Inventory::class,'inventory_id','id');
    }
}
