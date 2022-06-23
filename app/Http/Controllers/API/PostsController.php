<?php

namespace App\Http\Controllers\API;

use App\Events\PostCreated;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostsController extends Controller
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
        $input = $request->all();

        $validator = Validator::make($input, [
            'website_id' => ['required', Rule::exists('websites', 'id')],
            'title' => ['required', 'min:3'],
            'content' => ['required', 'min:10'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $post = new Post();
            $post->website_id = $request->website_id;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->save();

            $response = array(
                'data' => $post,
                'message' => 'Successfully created a new post for a website'
            );

            $newsletter = Newsletter::where('website_id', $post->website_id)->get();

            event(new PostCreated($newsletter, $post->title, $post->content));

            return response()->json($response, 201);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
