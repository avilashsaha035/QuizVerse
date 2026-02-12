<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_image',
        'date_of_birth',
        'division',
        'district',
        'upazilla',
        'address',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
