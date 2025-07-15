<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserResource extends JsonResource
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
            'email' => $this->email,
            'fullName' => $this->full_name,
            'gender' => $this->gender,
            'dateJoined' => $this->created_at->format('Y-m-d'),
            'avatarUrl' => $this->avatar_url,
            'role' => $this->getRoleNames(),
        ];
    }
}
