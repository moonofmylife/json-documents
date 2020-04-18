<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\{ JsonResource, ResourceCollection };

class DocumentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'documents' => $this->collection,
            'pagination' => [
                'page' => $this->currentPage(),
                'perPage' => $this->perPage(),
                'total' => $this->total()
            ],
        ];
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return JsonResource::toResponse($request);
    }
}
