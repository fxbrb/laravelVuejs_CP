<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->get();

        return response()->json([
            'data' => $projects
        ], 200);
    }

    public function new_project(Request $request)
    {

        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->link = $request->link;

        if ($request->photo) {
            $image = $request->photo;
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->photo)->save(public_path("/img/upload/") . $name);
            $project->photo = $name;
        }

        $project_save = $project->save();

        if ($project_save) {
            $response = [
                'success' => true,
                'data' => $project,
                'message' => "Projet ajouté avec succes."
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'data' => $project,
                'message' => "Impossible d'ajouté un projet."
            ];

            return response()->json($response);
        }
    }


    public function get_edit_project($id)
    {
        $project = Project::find($id);

        return response()->json([
            'project' => $project
        ], 200);
    }

    public function update_project(Request $request, $id)
    {
        $project = Project::find($id);

        $project->title = $request->title;
        $project->description = $request->description;
        $project->link = $request->link;
        if ($project->photo != $request->photo) {
            $image = $request->photo;
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $new_image = Image::make($request->photo);
            $project->photo = $name;
            if ($new_image != null) {
                $new_image->save(public_path("/img/upload/") . $name);
                $project->save();
            } else {
                $project->save();
            }
        }

        $project_save = $project->save();

        if ($project_save) {
            $response = [
                'success' => true,
                'data' => $project,
                'message' => "Projet mit a jour avec succes."
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'data' => $project,
                'message' => "Impossible de mettre a jour."
            ];

            return response()->json($response);
        }
    }

    public function delete_project($id)
    {
        $project = Project::find($id);
        File::delete(public_path("/img/upload/") . $project->photo);
        $project->delete();
    }
}
