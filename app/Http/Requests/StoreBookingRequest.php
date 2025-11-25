<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kamar' => 'required|exists:kamar,id_kamar',
            'tgl_check_in' => 'required|date',
            'tgl_check_out' => 'required|date|after:tgl_check_in',
            'pilihan_pembayaran' => 'required|string',
        ];
    }
}
