<?php

namespace App\Models;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
