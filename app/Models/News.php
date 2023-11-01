<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public const ACTIVE_STATUS = 'active';
    public const HIDDEN_STATUS = 'hidden';

    public static array $newsAllowedStatuses = [
        self::ACTIVE_STATUS,
        self::HIDDEN_STATUS
    ];

    public $fillable = [
        'title',
        'url',
        'short_description',
        'description',
        'status',
    ];

    public $timestamps = false;
}
