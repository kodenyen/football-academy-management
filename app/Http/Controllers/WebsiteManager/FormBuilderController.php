<?php

namespace App\Http\Controllers\WebsiteManager;

use App\Http\Controllers\Controller;
use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormBuilderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'form_type' => 'required|in:trial,coach',
            'label' => 'required|string|max:255',
            'field_type' => 'required|in:text,number,date,select,file,textarea',
            'is_required' => 'boolean',
            'options' => 'nullable|string', // Comma separated for select
        ]);

        $options = $request->options ? explode(',', $request->options) : null;
        if($options) {
            $options = array_map('trim', $options);
        }

        FormField::create([
            'form_type' => $request->form_type,
            'label' => $request->label,
            'field_name' => Str::slug($request->label, '_'),
            'field_type' => $request->field_type,
            'is_required' => $request->has('is_required'),
            'options' => $options,
            'order' => FormField::where('form_type', $request->form_type)->count() + 1,
        ]);

        return back()->with('success', 'Form field added successfully!');
    }

    public function destroy(FormField $field)
    {
        $field->delete();
        return back()->with('success', 'Form field removed!');
    }
}
