<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFooRequest;
use App\Http\Requests\UpdateFooRequest;
use App\Models\Foo;
use App\Transformers\FooTransformer;
use Illuminate\Http\Request;
use Spatie\Fractalistic\Fractal;

class FooController extends Controller
{
    public function index(Request $request): Fractal
    {
        $query = Foo::query()
            ->with([])
            ->paginate($request->get('per_page', 50));

        return fractal()->collection($query, new FooTransformer());
    }

    public function show(Foo $foo): Fractal
    {
        $foo->load([]);

        return fractal()->item($foo, new FooTransformer())
            ->parseIncludes([]);
    }

    public function store(CreateFooRequest $request): Fractal
    {
        $foo = Foo::create($request->validated());

        return $this->show($foo);
    }

    public function update(UpdateFooRequest $request, Foo $foo): Fractal
    {
        $foo->update($request->validated());

        return $this->show($foo->fresh());
    }
}
