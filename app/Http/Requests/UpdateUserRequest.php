<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function update(): void
    {
        $this->file("image")->storeAs("users", $this->user()->username);
    }

    public function rules(): array
    {
        return [
            "image" => ["required", "image"],
        ];
    }
}
