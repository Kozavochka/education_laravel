<?php

namespace App\Filters\Cars;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class YearRangeFilter implements Filter
{
    //invoke - одно действие
    public function __invoke(Builder $query, $value, string $property)
    {
        return $query
            ->when(!empty($value[0]),function (Builder $query) use ($value){
                $query->where('year','>=',$value[0]);
            })
            ->when(!empty($value[1]),function (Builder $query) use ($value){
                $query->where('year','<=',$value[1]);
            });
    }
}
