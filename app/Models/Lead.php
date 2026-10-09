<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'lead_type', 'ref_code', 'seq_number',
        'name', 'company', 'email', 'phone', 'product', 'message',
        'source', 'page_url', 'ip_address', 'device_type',
        'status', 'notes', 'wa_number',
        'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content',
    ];

    /**
     * Generate next atomic reference code UDSM-0001, UDSM-9999, UDSM-10000...
     */
    public static function generateNextRefCode(): array
    {
        return \Illuminate\Support\Facades\DB::transaction(function () {
            $maxSeq = static::max('seq_number') ?? 0;
            $nextSeq = $maxSeq + 1;
            $code = 'UDSM-' . str_pad((string)$nextSeq, 4, '0', STR_PAD_LEFT);
            return [
                'seq_number' => $nextSeq,
                'ref_code'   => $code,
            ];
        });
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'new'       => 'Baru',
            'contacted' => 'Dihubungi',
            'closed'    => 'Selesai',
            default     => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'new'       => '#FFD700',
            'contacted' => '#3B82F6',
            'closed'    => '#22C55E',
            default     => '#A1A1AA',
        };
    }

    public function getWaCustomerAttribute(): ?string
    {
        if (!$this->phone) return null;
        $phone = preg_replace('/[^0-9]/', '', $this->phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (str_starts_with($phone, '8')) {
            $phone = '62' . $phone;
        }
        return $phone;
    }

    public function scopePopup($query)     { return $query->where('lead_type', 'popup'); }
    public function scopeWaCode($query)    { return $query->where('lead_type', 'wa_code'); }
    public function scopeNew($query)       { return $query->where('status', 'new'); }
    public function scopeToday($query)     { return $query->whereDate('created_at', today()); }
    public function scopeThisMonth($q)    { return $q->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year); }
}
