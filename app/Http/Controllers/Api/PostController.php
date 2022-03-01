<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiResponseTrait;

class PostController extends Controller
{
    use ApiResponseTrait;

    public function index(){
        $posts=PostResource::collection(Post::get());
        return $this->response($posts,'ok','200');
    }
    public function show($id){
        $post=Post::find($id);
        if($post){
            return $this->response(new PostResource($post),'ok','200');
        }
        return $this->response(null,'post not found','400');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {

            return $this->response(null,$validator->errors(),'400');
        }
        $post=Post::create($request->all());
        if($post){
            return $this->response(new PostResource($post),'post is inserted','200');
        }
        return $this->response(null,'post not inserted','400');
    }
    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {

            return $this->response(null,$validator->errors(),'400');
        }
        $post=Post::find($id);

        if($post){
            $post->update($request->all());
            return $this->response(new PostResource($post),'post is updated','200');
        }
        return $this->response(null,'post not updated','400');
    }
    public function destroy($id){

        $post=Post::find($id);

        if($post){
            $post->delete($id);
            return $this->response(null,'post is deleted','200');
        }
        return $this->response(null,'post not found','400');
    }
}
