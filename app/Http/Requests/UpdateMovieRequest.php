<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string|required|min:3|max:100',
            'year' => 'numeric|min:1800',
            'genre' => 'required|string|exists:genres,name',
            'description' => 'string|max:5000|nullable',
            // 'video' => ['string', 'required', 'regex:/(yt:[a-zA-Z\-0-9]{11})|^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube(-nocookie)?\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/']
            'video' => ['string', 'required', 'regex:/yt:[^"&?/\s]{11}/']
        ];
    }
}
