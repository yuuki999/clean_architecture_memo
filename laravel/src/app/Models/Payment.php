<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'currency',
        'status',
        'payment_method',
        'user_id',
    ];

    protected $casts = [
        'amount' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isSuccessful()
    {
        return $this->status === 'successful';
    }

    public function markAsSuccessful()
    {
        $this->status = 'successful';
        $this->save();
    }

    public function markAsFailed()
    {
        $this->status = 'failed';
        $this->save();
    }
}
