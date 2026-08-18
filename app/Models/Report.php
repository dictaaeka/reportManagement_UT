<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Issue;
use App\Models\Site;
use App\Models\User;
use App\Models\Customer;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_id',
        'site_id',
        'month',
        'year',
        'customer_id',
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
        'uploader_id',
    ];

    protected $casts = [
        'month' => 'integer',
        'year' => 'integer',
        'file_size' => 'integer',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Mapping angka bulan (1-12) ke nama bulan Indonesia.
     * Hanya dipakai untuk tampilan/filter, data di database tetap disimpan sebagai angka.
     *
     * @return array<int, string>
     */
    public static function monthNames(): array
    {
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
    }

    /**
     * Nama bulan untuk instance report ini, mengikuti nilai kolom `month`.
     */
    public function monthName(): string
    {
        return self::monthNames()[$this->month] ?? '—';
    }
}
