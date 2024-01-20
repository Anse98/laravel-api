<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $results = Project::with('type', 'technologies')->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'projects' => $results,
            'success' => true
        ]);
    }


    public function show(Project $project)
    {
        // Aggiungere qua type.projects, serve per recuperare anche tutti i progetti che hanno quel type

        // La function in type.projects serve in questo caso per escludere l'id del progetto in types con lo stesso id del progetto, in poche parole 'prendimi tutti i dati tranne quelli dove id(di type.projects) è diverso dall'id del progetto'. 
        $project->load(['type', 'technologies', 'type.projects' => function ($query) use ($project) {
            $query->where('id', '<>', $project->id);
        }, 'type.projects.technologies']);

        return response()->json([
            'project' => $project,
            'success' => true
        ]);
    }
}
