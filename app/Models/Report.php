<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Issue;
use App\Models\Site;
use App\Models\User;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_id',
        'site_id',
        'month',
        'year',
        'title',
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
}
