<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use External\Foo\Movies\MovieService as FooMovie;
use External\Bar\Movies\MovieService as BarMovie;
use External\Baz\Movies\MovieService as BazMovie;

class MovieController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getTitles(Request $request, FooMovie $fooMovie, BarMovie $barMovie, BazMovie $bazMovie): JsonResponse
    {
        // TODO
        $array = [];
        try{
            foreach($fooMovie->getTitles() as $value)
            {
                $array[] = $value;
            }
        }catch(\Exception|\Throwable $ex)
        {}

        try{
            $bazMovies = $bazMovie->getTitles();
            foreach($bazMovies['titles'] as $value)
            {
                $array[] = $value;
            }
        }catch(\Exception|\Throwable $ex){

        }

        try{
            $barMovies = $barMovie->getTitles();
            foreach($barMovies['titles'] as $index => $values)
            {
                $array[] = $barMovies['titles'][$index]['title'];
            }
        }catch(\Exception|\Throwable $ex)
        {

        }

        return response()->json($array);
    }
}
