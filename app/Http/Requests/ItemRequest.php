<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "type_id" => "required|integer",
            "brand_id" => "required|integer",
            "photos" => "nullable|array",
            "photos.*" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2000",
            "price" => "nullable|integer",
            "star" => "nullable|numeric",
            "review" => "nullable|integer",
        ];
    }
}
