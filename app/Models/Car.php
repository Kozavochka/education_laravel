<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property int $id
 * @property string $name
 * @property int $year
 * @property int $price
 * @property bool $is_new
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class Car extends Model
{

    use HasFactory;

    /* какие поля возможные для заполнения*/
    protected  $fillable=[
        'name',
        'year',
        'is_new',
        'price',
    ];

    /* преообразователь - то, что под bool преобрузаем в не bool backend*/
    // преобразуем поле в bool( из базового в бэкэдн)
    protected  $casts=[
      'is_new'=>'bool'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    //Аксессор - преобразование полей. Get
    public function getFormatPriceAttribute()
    {
        return bcdiv($this->price, 100, 2);
    }

    //Мутатор - преобразование полей. Post
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    //Scope - условие
    public function scopeNew(Builder $query): void
    {
        $query->where('is_new', 1);
    }
}
