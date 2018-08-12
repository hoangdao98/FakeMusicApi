<?php

namespace App\Http\Controllers;


use App\Model\Album;
use App\Exceptions\AlbumNotBelongsToUser;
use App\Http\Resources\Album\AlbumResource;
use App\Http\Resources\Album\AlbumCollection;
use App\Http\Requests\AlbumRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;


class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AlbumCollection::collection(Album::orderBy('id', 'desc')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request, Album $album)
    {
        $album = new Album;
        $album->name = $request->name;
        $album->description = $request->description;
        $album->singer = $request->singer;
        $album->year = $request->year;
        $album->user_id = $request->user_id;
        if($request->has("image")){
            $files = $request->image;
            $fileData = explode(',', $files);
            if(preg_match('/(?<=\/)[^;]*/', $fileData[0], $fileExtension)){
                $fileName = str_slug(uniqid() . microtime()) . "." . $fileExtension[0];
                $path = public_path('upload/' . $fileName);
                $data = base64_decode($fileData[1]);
                file_put_contents( $path, $data );
                $album->image = $fileName;
            }
        }
        $album->save();
        return response()->json($album);
        return response([
            'data' => new AlbumResource($album)
        ],Response::HTTP_CREATED);
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        return new AlbumResource($album);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $this->AlbumUserCheck($album);
        $requestData = $request->all();
        if($request->has('newImage')){
            $files = $request->newImage;
            $fileData = explode(',', $files);
            if(preg_match('/(?<=\/)[^;]*/', $fileData[0], $fileExtension)){
                $fileName = str_slug(uniqid() . microtime()) . "." . $fileExtension[0];
                $path = public_path('upload/' . $fileName);
                $data = base64_decode($fileData[1]);
                file_put_contents( $path, $data );
                $requestData['image'] = $fileName;
            }
        }
        $album->update($requestData);
        return response([
            'data' => new AlbumResource($album)
        ],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $this->AlbumUserCheck($album);
        $album->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }

    public function AlbumUserCheck($album){
        if(Auth::id() !== $album->user_id){
            throw new AlbumNotBelongsToUser;
        }
    }
}
