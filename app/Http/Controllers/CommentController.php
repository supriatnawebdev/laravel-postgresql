<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
           $request['user_id'] = Auth::user()->id;
            $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required',
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
                $comment = new Comment();
                $comment->post_id = $request->input('post_id');
                $comment->user_id = $request->input('user_id');
                $comment->comments_content = $request->input('comments_content');
                $comment->save();

                // Kirimkan respons sukses
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan.',
                    'data' => new CommentResource($comment->loadMissing(['commentator:id,username'])),
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
          // Validasi input menggunakan Validator
    $request['user_id'] = Auth::user()->id;
    $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'comments_content' => 'required',
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
        
        $comment = Comment::findOrFail($id);
        $comment->update([
            'user_id' => $request->get('user_id'),
            'comments_content' => $request->get('comments_content'),
       
        ]);

      // Kirimkan respons sukses
      return response()->json([
        'success' => true,
        'message' => 'Data berhasil di update.',
        'data' => new CommentResource($comment->loadMissing(['commentator:id,username'])),
    ], 201);
} catch (\Exception $e) {
    // Tangani kegagalan penyimpanan data
    return response()->json([
        'error' => true,
        'message' => 'Terjadi kesalahan saat mengupdate data.',
    ], 500);
}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Comment::find($id);

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
