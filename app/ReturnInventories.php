<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnInventories extends Model
{
    //
    public function return_inventories()
    {
        return $this->hasMany(ReturnInventories::class,'emp_code','emp_code');
    }
    public function inventory_data()
    {
        return $this->belongsTo(Inventory::class,'inventory_id','id');
    }
    public function employee_inventories()
    {
        return $this->belongsTo(EmployeeInventories::class,'employee_inventory_id','id');
    }
}
