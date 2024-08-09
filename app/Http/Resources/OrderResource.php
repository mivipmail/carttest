<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'created_at' => Carbon::parse($this->created_at)->format('d.m.Y H:i:s'),
            'items' => $this->items->toArray(),
            'count' => $this->items->sum(fn ($item) => $item->quantity),
            'sum' => $this->items->sum(fn ($item) => $item->price * $item->quantity),
        ];
    }
}
