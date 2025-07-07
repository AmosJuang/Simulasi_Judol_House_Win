<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id', 
        'control_type',
        'times_to_apply',
        'reason',
        'is_applied'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}