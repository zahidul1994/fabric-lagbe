<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EducationDegreeCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'response' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'education_level_id' => (string) $data->education_level_id,
                    'name' => (string) $data->name,
                    'name_bn' => (string) $data->name_bn,
                    'created_at' => (string) $data->created_at,
                    'updated_at' => (string) $data->updated_at,
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
//            'status' => 200
        ];
    }
}
