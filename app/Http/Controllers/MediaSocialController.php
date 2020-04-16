<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\MediaSocial;
use App\User;

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
    public function addSocialMedia(Request $request, $id)
    {
        $result = User::find($id);
        //validate incoming request 
        $this->validate($request, [
            'social_media' => 'required|string',
            'username' => 'required|string',
        ]);

        try {
            $media = new MediaSocial;
            $media->user_id = $result->id;
            $media->social_media = $request->input('social_media');
            $media->username = $request->input('username');

            $media->save();

            //return successful response
            return response()->json(['user' => $media, 'message' => 'SOCIAL MEDIA CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e], 409);
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
