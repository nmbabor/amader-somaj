<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'father_name', 'phone', 'email', 'address', 'occupation',
        'tier', 'membership_no', 'status', 'message', 'joined_at',
    ];

    protected $casts = [
        'joined_at' => 'date',
    ];

    public const TIERS = [
        'general' => 'সাধারণ সদস্য',
        'lifetime' => 'আজীবন সদস্য',
        'donor' => 'দাতা সদস্য',
    ];

    public const STATUSES = [
        'pending' => 'অপেক্ষমাণ',
        'approved' => 'অনুমোদিত',
        'rejected' => 'বাতিল',
    ];

    public function getTierLabelAttribute(): string
    {
        return self::TIERS[$this->tier] ?? $this->tier;
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}