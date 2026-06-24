<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    //
    public function index()
    {
        $projects = Projects::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'teknologi' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $imagePath);
    }

    Projects::create([
        'title' => $request->title,
        'description' => $request->description,
        'teknologi' => $request->teknologi,
        'image' => $imagePath,
        'status' => $request->status,
    ]);

    return redirect()->route('projects.index')->with('success', 'Project created successfully.');
}

    public function edit($id)
    {
        $project = Projects::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id) 
    {
       $request->validate([
    'title' => 'required',
    'description' => 'required',
    'teknologi' => 'required',
    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
]);

$project = Projects::findOrFail($id);
$imagePath = $project->image;

if ($request->hasFile('image')) {
    if ($project->image && file_exists(public_path('images/' . $project->image))) {
    unlink(public_path('images/' . $project->image));
}

    $imagePath = time() . '_' . $request->file('image')->getClientOriginalName();
    $request->file('image')->move(public_path('images'), $imagePath);
    $project->image = $imagePath;
}

$project->update([
    'title' => $request->title,
    'description' => $request->description,
    'teknologi' => $request->teknologi,
    'image' => $imagePath,
    'status' => $request->status,
]);

return redirect()->route('projects.index')->with('success', 'Project updated successfully.'); 
    }
    
    public function destroy($id)
    {
        $project = Projects::findOrFail($id);
        
        // if ($project->image) {
        //     unlink(public_path('images/' . $project->image));
        // }

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function cetakPdf()
{
    $projects = Projects::all();
    $pdf = Pdf::loadView('admin.projects.pdf', compact('projects'));

    return $pdf->stream('projects.pdf');
}

public function cetakByid($id)
    {
        $project = Projects::findOrFail($id);
        $pdf = Pdf::loadView('admin.projects.pdf-by-id', compact('project'));

        return $pdf->stream('project_'.$id.'.pdf');
    }
}