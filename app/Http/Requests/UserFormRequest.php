<?php

namespace App\Http\Requests;

use App\Models\FormField;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $formField = FormField::with('input')->where('form_id', $this->id)->get();
        $rules = [];
        foreach ($formField as $field) {
            if ($field->is_required) {
                $rules = array_merge($rules, [
                    'form_'.$field->id => 'required'
                ]);
            }
        }

        return $rules;
    }
}
