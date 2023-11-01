<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    protected bool $withDescription = false;

    public function withDescription(): static
    {
        $this->withDescription = true;
        return $this;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'shortDescription' => $this->short_description,
            'status' => $this->status,
            'createdAt' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];

        if ($this->withDescription) {
            $data['description'] = $this->description;
        }

        return $data;
    }
}
