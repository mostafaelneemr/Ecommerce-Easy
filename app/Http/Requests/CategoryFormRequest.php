<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            case 'PUT':
            case 'PATCH':
                return [
                    'category_name_en' => 'required',
                    'category_name_ar' => 'required',
                    'category_icon' => 'required',
                ];

            default:
                break;
        }
    }
}
