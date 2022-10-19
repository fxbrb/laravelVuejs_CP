<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::orderBy('id', 'desc')->first();

        return response()->json($about);
    }


    public function update_about(Request $request, $id)
    {
        $about = About::find($id)->first();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);


        $about->name = $request->name;
        $about->email = $request->email;
        $about->phone = $request->phone;
        $about->address = $request->address;
        $about->description = $request->description;
        $about->tagline = $request->tagline;

        if ($about->photo != $request->photo) {
            $image = $request->photo;
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $new_image = Image::make($request->photo);
            $about->photo = $name;
            if($new_image != null) {
                $new_image->save(public_path("/img/upload/") . $name);
                $about_update = $about->save();
            } else {
                $about_update = $about->save();
            }
        }

        if ($about->cv != $request->cv) {
            $image = $request->cv;
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $new_cv = Image::make($request->cv);
            $about->cv = $name;
            if($new_cv != null) {
                $new_cv->save(public_path("/img/upload/") . $name);
                $about_update = $about->save();
            } else {
                $about_update = $about->save();
            }
        }
        $about_update = $about->save();

        if ($about_update) {
            $response = [
                'success' => true,
                'data' => $about,
                'message' => "Utilisateur mit a jour avec succes."
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'data' => $about,
                'message' => "Impossible de mettre a jour."
            ];

            return response()->json($response);
        }
    }
}
