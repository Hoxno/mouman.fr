<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'firstname' => ['string','max:10'],
            'lastname' => ['string','max:10'],
            'jobtitle'=> ['string','min:3'],
            'about'=> ['min:3'],
            'image' => ['image', 'mimes:jpeg,jpg,svg', 'max:2048'],
            'pdf_file' => ['file','mimes:pdf', 'max:2048'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
