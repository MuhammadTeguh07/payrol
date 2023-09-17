<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penggajian extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'penggajian';
    protected $fillable = [
        'id',
        'user_id',
        'date',
        'paid_amount',
        'work_paid',
        'izin_duration',
        'izin_charge',
        'overtime_duration',
        'overtime_paid',
        'tunjangan',
        'bpjs',
        'intensif',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id','user_id');
    }
}