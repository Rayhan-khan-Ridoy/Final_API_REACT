<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branche;

class Adminregistration extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function branche(){

            return $this->belongsTo(Branche::class);
    }

}
