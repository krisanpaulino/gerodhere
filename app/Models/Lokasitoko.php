<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasitoko extends Model
{
    protected $table = 'lokasitoko';
    protected $primaryKey = 'lokasitoko_id';
    public $guarded = ['lokasitoko_id'];
    public $timestamps = false;
}
