<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Komplain extends Model
{
    protected $table = 'komplain';
    protected $primaryKey = 'komplain_id';
    public $incrementing = true;
    public $timestamps = true;
    // protected $dateFormat = 'TIMESTAMP';
    public $guarded = ['komplain_id'];

    function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'transaksi_id');
    }
}
