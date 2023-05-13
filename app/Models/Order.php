<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 *
 * @property int $id
 * @property int $user_id
 * @property bool $is_paid
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Collection $cars
 * @property User $user
 *
 */
class Order extends Model
{
    use HasFactory;

    /* какие поля возможные для заполнения*/
    protected  $fillable=[
        'user_id',
        'is_paid',
        'description',
    ];

    protected  $casts=[
        'is_paid'=>'bool'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class);
    }
}
