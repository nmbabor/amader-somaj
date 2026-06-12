<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name', 'phone', 'email', 'amount', 'method',
        'transaction_id', 'status', 'note', 'donated_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'donated_at' => 'datetime',
    ];

    public const METHODS = [
        'bkash' => 'বিকাশ',
        'nagad' => 'নগদ',
        'cash' => 'নগদ অর্থ',
        'bank' => 'ব্যাংক',
    ];

    public const STATUSES = [
        'pending' => 'অপেক্ষমাণ',
        'verified' => 'যাচাইকৃত',
        'rejected' => 'বাতিল',
    ];

    public function getMethodLabelAttribute(): string
    {
        return self::METHODS[$this->method] ?? $this->method;
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }
}