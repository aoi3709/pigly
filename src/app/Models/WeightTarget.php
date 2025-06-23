<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WeightTarget extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'target_weight',
    ];

    /**
     * この目標体重を所有するユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
