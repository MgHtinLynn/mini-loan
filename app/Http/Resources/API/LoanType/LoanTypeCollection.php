<?php

namespace App\Http\Resources\API\LoanType;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LoanTypeCollection extends ResourceCollection
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
            'status' => 200,
            'message' => "Success",
            'data' => LoanTypeResource::collection($this->collection)
        ];
    }
}
