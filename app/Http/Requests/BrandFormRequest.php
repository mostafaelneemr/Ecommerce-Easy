<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandFormRequest extends FormRequest
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
                    'brand_name_en' => 'required',
                    'brand_name_ar' => 'required',
                    'brand_image' => 'required',
                ];

            default:
                break;
        }
    }
}
