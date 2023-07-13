<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFooRequest;
use App\Http\Requests\UpdateFooRequest;
use App\Models\Foo;
use App\Transformers\FooTransformer;
use Illuminate\Http\Request;

class FooController extends Controller
{
    public function index(Request $request)
    {
        $query = Foo::query()
            ->with([]);

        return fractal()->collection($query->paginate($request->get('per_page', 50)), new FooTransformer());
    }

    public function show(Foo $foo)
    {
        $foo->load([]);

        return fractal()->item($foo, new FooTransformer())
            ->parseIncludes([]);
    }

    public function store(CreateFooRequest $request)
    {
        $foo = Foo::create($request->validated());

        return $this->show($foo);
    }

    public function update(UpdateFooRequest $request, Foo $foo)
    {
        $foo->update($request->validated());

        return $this->show($foo->fresh());
    }
}
