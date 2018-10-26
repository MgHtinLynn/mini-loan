<?php

namespace App\Http\Resources\API\Role;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed role_name
 * @property mixed id
 */
class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'role_name' => $this->role_name,
        ];
    }
}
