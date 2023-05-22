<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        // return response()->json(['datas' => $post]);
        return PostDetailResource::collection($posts->loadMissing('writer:id,username', 'comments'));

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
  


public function store(Request $request)
{
    // Validasi input menggunakan Validator
    $request['author'] = Auth::user()->id;
    $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'news_content' => 'required',
            'author' => 'required'
    ]);

    // Jika validasi gagal, kirimkan respons berupa pesan kesalahan
    if ($validator->fails()) {
        return response()->json([
            'error' => true,
            'message' => $validator->errors(),
        ], 400);
    }

    // Proses penyimpanan data
    try {
        // Lakukan penyimpanan data ke database atau sumber data lainnya
        // Contoh:
        $post = new Post();
        $post->title = $request->input('title');
        $post->news_content = $request->input('news_content');
        $post->author = $request->input('author');
        $post->save();

        // Kirimkan respons sukses
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan.',
            'data' => new PostDetailResource($post->loadMissing('writer:id,username'))
        ], 201);
    } catch (\Exception $e) {
        // Tangani kegagalan penyimpanan data
        return response()->json([
            'error' => true,
            'message' => 'Terjadi kesalahan saat menyimpan data.',
        ], 500);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('writer:id,username,email')->findOrFail($id);

        return new PostDetailResource($post);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi input menggunakan Validator
    $request['author'] = Auth::user()->id;
    $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'news_content' => 'required',
            'author' => 'required'
    ]);

    // Jika validasi gagal, kirimkan respons berupa pesan kesalahan
    if ($validator->fails()) {
        return response()->json([
            'error' => true,
            'message' => $validator->errors(),
        ], 400);
    }

    // Proses penyimpanan data
    try {
        // Lakukan penyimpanan data ke database atau sumber data lainnya
        // Contoh:
        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->get('title'),
            'news_content' => $request->get('news_content'),
            'author' => $request->get('author'),
       
        ]);

        // Kirimkan respons sukses
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan.',
            'data' => new PostDetailResource($post->loadMissing('writer:id,username'))
        ], 201);
    } catch (\Exception $e) {
        // Tangani kegagalan penyimpanan data
        return response()->json([
            'error' => true,
            'message' => 'Terjadi kesalahan saat menyimpan data.',
        ], 500);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(!$post){
            return response()->json([
                'message' => 'data not found',
                'error' => true
            ], 404);
        } else {
            $post->delete();
            return response()->json([
                // 'data' => [],
                'message' => 'Post deleted successfully',
                'success' => true
            ]);
        }
       
    }
}