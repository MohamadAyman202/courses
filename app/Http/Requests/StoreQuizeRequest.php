<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'lesson_id' => 'required|exists:lessons,id',
            'status' => 'required|in:active,inactive',
            'end_time' => 'required|date_format:H:i',
            'again_quize' => 'required|boolean',
            'score' => 'required|numeric',
        ];
    }
}
