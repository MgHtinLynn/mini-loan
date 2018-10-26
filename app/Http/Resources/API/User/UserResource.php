<?php

namespace App\Http\Resources\API\User;

use App\Http\Resources\API\Role\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed email
 * @property mixed verify_token
 * @property mixed nrc_address
 * @property mixed message
 * @property mixed status
 */
class UserResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        return [
            'status' => $this->status ?? 200,
            'message' => $this->message
        ];
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->verify_token,
            'nrc_address' => $this->nrc_address,
            'role' => new RoleResource($this->whenLoaded('role'))
        ];
    }
}
