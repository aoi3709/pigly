<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WeightLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'date',
        'weight',
        'calories',
        'exercise_time',
        'exercise_content',
    ];

    /**
     * この体重ログを所有するユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}