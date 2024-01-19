<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $results = Type::with('projects', 'projects.type', 'projects.technologies')->get();

        return response()->json([
            'types' => $results,
            'success' => true
        ]);
    }
}
