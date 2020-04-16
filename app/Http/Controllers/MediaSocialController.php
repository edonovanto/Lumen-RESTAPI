<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\MediaSocial;

class MediaSocialController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function addSocialMedia(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'media_social' => 'required|string',
            'username' => 'required|string',
        ]);

        try {
            $media = new MediaSocial;
            $media->media_social = $request->input('media_social');
            $media->username = $request->input('username');

            $media->save();

            //return successful response
            return response()->json(['user' => $media, 'message' => 'SOCIAL MEDIA CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Social Media Registration Failed!'], 409);
        }

    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allSocialMedia()
    {
        $result = MediaSocial::all();

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        }
        else {
            $data['code'] = 500;
            $data['result'] = 'error';
        }

        return response()->json($data);
    }

    public function update(Request $request, $id){
        $result = MediaSocial::find($id);
        $result->fill($request->all());
        $result->save();

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        }
        else {
            $data['code'] = 500;
            $data['result'] = 'error';
        }
        
        return response($data);
    }

}
