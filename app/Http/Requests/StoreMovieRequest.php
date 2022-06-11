<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMovieRequest extends FormRequest
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
            'year' => 'numeric|min:1800|max:' . now()->year,
            'genre' => 'required|alpha|min:1|exists:genres,name',
            'description' => 'string|max:5000|nullable',
            // 'video' => ['string','required','regex:/(yt:\w{11})|^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube(-nocookie)?\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/']
            'video' => ['string', 'required', 'regex:/^yt:[^\x22&?\x2F\s]{11}$/']
        ];
    }
}
