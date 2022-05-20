<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Notifiable;
    //
    public function inventories()
    {
        return $this->hasMany(InventoryTransaction::class);
    }
}
