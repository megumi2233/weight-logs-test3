<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightTarget extends Model
{
    use HasFactory;

    protected $table = 'weight_target';

    protected $fillable = [
        'user_id',
        'current_weight',
        'target_weight',
        'target_date',
    ];

    protected $casts = [
        'target_date' => 'date',
        'target_weight' => 'decimal:1',
        'current_weight' => 'decimal:1',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
