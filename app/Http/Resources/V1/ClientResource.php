<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'avatar_url' => $this->avatar_url,
            'role' => $this->getRoleNames(),
            'permissions' => $this->getAllPermissions()->pluck('name'),
        ];
    }
}
