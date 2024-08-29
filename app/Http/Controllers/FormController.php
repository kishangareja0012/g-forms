<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\Form;
use App\Models\FormField;
use App\Models\FormUser;
use App\Models\Input;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FormController extends Controller
{
    public function index()
    {
        $inputs = Input::all();
        $forms = Form::orderBy('created_at', 'desc')->get();

        return view('forms.index', [
            'inputs' => $inputs,
            'forms' => $forms,
        ]);
    }

    public function create(Request $request)
    {
        try {
            $form = Form::create([
                'title' => $request->title['value'],
                'description' => $request->description['value']
            ]);

            foreach ($request->data as $field) {
                FormField::create([
                    'form_id' => $form->id,
                    'input_id' => $field['type'],
                    'label' => $field['label']['value'],
                    'options' => $field['options']['value'],
                    'is_required' => $field['isRequired']
                ]);
            }

            return jsonResponse(true, FORM_CREATED, Response::HTTP_CREATED, "Form created successfully");
        } catch (Exception $e) {
            return jsonResponse(false, EXCEPTION, Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    public function userFormView($id)
    {
        $form = Form::with('formField.input')->findOrFail($id);

        return view('forms.user', [
            'form' => $form
        ]);
    }

    public function userFormRequest(UserFormRequest $request, $id)
    {
        try {

            unset($request['_token']);
            $userInfo = [];
            foreach ($request->all() as $key => $value) {
                $field = [
                    'input_id' => (int) trim($key, 'form_'),
                    'value' => $value
                ];
                $userInfo[] = $field;
            }
            FormUser::create([
                'form_id' => $id,
                'meta' => $userInfo
            ]);

            return back()->with('successMessage', 'Form submitted successfully');
        } catch (Exception $e) {
            return back()->with('errorMessage', $e->getMessage());
        }
    }
}
