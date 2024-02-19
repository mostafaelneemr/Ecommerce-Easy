<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubSubCategoryFormRequest extends FormRequest
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
                    'category_id' => 'required',
                    'subcategory_id' => 'required',
                    'subsubcategory_name_en' => 'required',
                    'subsubcategory_name_ar' => 'required',
                ];

            default:
                break;
        }
    }
}
