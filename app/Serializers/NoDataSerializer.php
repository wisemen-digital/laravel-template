<?php

/**
 * Created by PhpStorm.
 * User: jonasl
 * Date: 11/10/2016
 * Time: 14:18
 */

namespace App\Serializers;

use League\Fractal\Serializer\ArraySerializer;

//Deletes all 'data' fields from collections
class NoDataSerializer extends ArraySerializer
{
    public function collection($resourceKey, array $data): array
    {
        return $data;
    }

    public function null(): ?array
    {
        return null;
    }
}
