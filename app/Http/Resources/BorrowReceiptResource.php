<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BorrowReceiptResource extends JsonResource
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
            'receipt_id' => $this->receipt_id,
            'borrow_date' => $this->borrow_date,
            'due_date' => $this->due_date,
            'return_date' => $this->return_date,
            'status' => $this->status,
            'user' => new UserResource($this->whenLoaded('user')),
            'receipt_details' => ReceiptDetailResource::collection($this->whenLoaded('receiptDetails')),
        ];
    }
}

