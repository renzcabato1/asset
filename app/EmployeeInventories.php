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
    public function EmployeeInventories()
    {
        return $this->hasMany(EmployeeInventories::class,'emp_code','emp_code')->where('generated',null)->where('status',"Active");
    }
}
