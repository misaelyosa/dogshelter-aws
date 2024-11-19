<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doge extends Model
{
    use HasFactory;

    protected $table = 'doge';

    protected $fillable = ['nama', 'dob', 'trait', 'jenis_kelamin', 'keterangan', 'vaccin_status'];

    public function adopter(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
