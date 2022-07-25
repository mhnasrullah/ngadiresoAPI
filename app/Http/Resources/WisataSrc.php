<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WisataSrc extends JsonResource
{
    protected $status,$msg;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function __construct($status,$msg,$src){
        parent::__construct($src);
        $this->status = $status;
        $this->msg = $msg;
    }
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'status' => $this->status,
            'message' => $this->msg,
            'data' => $this->resource 
        ];
    }
}
