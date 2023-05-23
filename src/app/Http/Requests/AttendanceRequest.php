<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'working_st' => Rule::unique('attendances')->where(function ($query) {
                return $query->where('user_id', Auth::id())->where('working_st',carbon::now());
            })
        ];
    }

    public function messages()
    {
        return [
            'working_st' => '既に打刻されています',
        ];
    }
}