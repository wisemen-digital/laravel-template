<?php

namespace App\Transformers;

use App\Models\Foo;
use League\Fractal\TransformerAbstract;

class FooTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [];

    protected array $availableIncludes = [];

    public function __construct()
    {
    }

    public function transform(Foo $resource)
    {
        return [
            'id' => $resource->id,

            'name' => $resource->name,

            'created_at' => $resource->created_at?->toDateTimeString(),
            'updated_at' => $resource->updated_at?->toDateTimeString(),
        ];
    }
}
