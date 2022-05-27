<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    //
    use Notifiable;

    public function items()
    {
        return $this->hasMany(ReturnInventoryData::class,'transaction_id','id');
    }
}
