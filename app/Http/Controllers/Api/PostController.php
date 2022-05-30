<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponse;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->apiResponse(Post::all(), 'success', 200);
    }


    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return $this->apiResponse($post, 'success', 200);
        }
        return $this->apiResponse($post, 'Not Found Post With ID', 404);
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|max:60',
            'body' => 'required'
        ]);
        if ($validate->fails()) {
            return $this->apiResponse(null, $validate->errors(), 404);
        }
        $post = Post::create($request->all());
        if ($post) {
            return $this->apiResponse($post, 'Post Saved', 201);
        }
        return $this->apiResponse($post, 'The post not saved', 404);
    }


    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|max:60',
            'body' => 'required'
        ]);
        if ($validate->fails()) {
            return $this->apiResponse(null, $validate->errors(), 404);
        }
        $post = Post::find($id);
        if ($post) {
            $post->update($request->all());
            return $this->apiResponse($post, 'Updated Post Successfully', 200);
        }
        return $this->apiResponse($post, 'Failed to found post id', 404);
    }
    
    public function delete($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->apiResponse(null, 'The post not found', '404');
        }
        $post->delete($id);
        return $this->apiResponse(null, 'the post Deleted Successfully', '200');
    }
}
