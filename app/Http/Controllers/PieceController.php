<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PieceController extends Controller
{
    public function addAjax(Section $section, Request $request)
    {

        if (!$section->is_active) {
            echo json_encode(['message' => 'This section is not activated']);
            exit;
        }

        $validatedData = $request->validate([
            //'text' => 'required|min:1|unique:pieces,text,section_id',
            'text' => ['required', 'min:1', Rule::unique('pieces')->where(function($query) use ($section){
                return $query->where('section_id', $section->id); // text needs to be unique only for this section
            })]
        ], ['text.unique' => 'This custom text has already been saved']);

        $section->pieces()->create(['text' => $validatedData['text']]);

        echo json_encode(['success' => true]);
        exit;
    }
}
