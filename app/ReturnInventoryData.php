<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnInventoryData extends Model
{
    //
    public function employee_inventory_d()
    {
        return $this->belongsTo(EmployeeInventories::class,'employee_inventory','id');
    }
}
