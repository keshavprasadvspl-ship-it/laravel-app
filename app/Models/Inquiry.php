<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public const STATUS_NEW = 'new';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_QUOTED = 'quoted';
    public const STATUS_SAMPLE_SENT = 'sample_sent';
    public const STATUS_CLOSED = 'closed';

    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'New Inquiry',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_QUOTED => 'Quotation Sent',
            self::STATUS_SAMPLE_SENT => 'Sample Dispatched',
            self::STATUS_CLOSED => 'Closed / Completed',
        ];
    }

    public static function getInquiryTypes(): array
    {
        return [
            'quote' => 'Bulk Price Quotation',
            'sample' => 'Lab Sample Request',
            'tds' => 'Technical Data Sheet (TDS)',
            'msds' => 'Safety Data Sheet (MSDS)',
            'general' => 'General Inquiry / Technical Guidance',
        ];
    }
}
