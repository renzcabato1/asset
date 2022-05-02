<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrowerinformation extends Model
{
    //
    public function attachments()
    {
        return $this->hasMany(BorrowerAttachment::class,'borrower_informations_id','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
