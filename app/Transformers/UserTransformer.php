<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [];

    protected array $availableIncludes = [];

    public function __construct()
    {
    }

    public function transform(User $resource)
    {
        return [
            'id' => $resource->id,

            'email' => $resource->email,
            'role' => $resource->role,

            'first_name' => $resource->first_name,
            'last_name' => $resource->last_name,

            'created_at' => $resource->created_at?->timestamp,
            'updated_at' => $resource->updated_at?->timestamp,
        ];
    }
}
