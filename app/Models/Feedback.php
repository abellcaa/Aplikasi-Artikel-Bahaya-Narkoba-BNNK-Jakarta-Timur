<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    public const CATEGORIES = [
        'permohonan_penyuluhan' => 'Permohonan Penyuluhan',
        'saran_fitur' => 'Saran Fitur',
        'permohonan_rehabilitasi' => 'Permohonan Rehabilitasi',
    ];

    protected $table = 'feedbacks';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'subject',
        'category',
        'message',
        'status',
        'admin_reply',
        'replied_at',
        'replied_by',
    ];

    protected function casts(): array
    {
        return [
            'replied_at' => 'datetime',
        ];
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->subject;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function repliedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'replied_by');
    }
}
