<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    use HasFactory;
    protected $table = 'log_table';
    protected $primaryKey = 'id';
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'request_ip',
        'created_at',
        'status',
    ];

    public $timestamps = FALSE;
}
