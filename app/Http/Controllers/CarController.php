<?php

namespace App\Http\Controllers;

use App\Filters\Cars\YearRangeFilter;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\OrderComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/*php artisan make:controller CarController --resource -  с предустановленным методами*/
class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()//GET запрос - получение всех элементов сущности
    {
//         dd(User::find(1)->comments);
//         dd(OrderComment::find(1)->order->user);
        //jhjksdahjsdjhadak
        //dsasdadadasasd

        $page = request('page', 1);//страница
        $perPage = request('per_page', 1);//кол-во элементов на странице
        // возвращение коллекции машин
        $year = request('filter_year');
       /* $query = Car::query();*/

        return CarResource::collection(
            //https://spatie.be/docs/laravel-query-builder/v5/features/filtering
            QueryBuilder::for(Car::class)
                //фильтрация, логические пересечения
                ->allowedFilters([
                    'name',//фильтр содержания
                    AllowedFilter::exact('year'),//фильтр по значению, точечный
                    AllowedFilter::custom('year_range', new YearRangeFilter),//custom фильтр по диапазону, year_range-property
                        AllowedFilter::callback('has_orders', function (Builder $query, $value) {
                            $query->whereHas('orders');
    //                        $query->whereHas('orders', null, '>=', $value);
                        })
                ])
                ->allowedSorts('price')
                ->new()
                ->paginate($perPage, '*', 'page', $page)
        );


    }

    public function create()// метод отрисовки
    {

    }

    public function store(CarRequest $request)//POST запрос - сохранение сущности
    {
        // преобразование данных
        $data = $request->prepareData();

        //создание  сущности машины и отправка в БД
        $car= Car::query()->create($data);

        // отображение машинки
        return new CarResource($car);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CarResource
     */


    public function show(Car $car )// GET запрос - показывает один элемент из сущности
    {
        return new CarResource($car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)// методы для отрисовки страницы
    {

    }


    public function update(CarRequest $request, Car $car)//PATCH/PUT запрос. PATCH - обновление сущ. . PUT - положить новую запись
    {
        $data=$request->prepareData();

        $car->update($data);

        return new CarResource($car);
    }

    public function destroy(Car $car)//DELETE запрос
    {
        $car->delete();
        return [
            'result' => true,
        ];
    }
}
