<?php

namespace App\Http\Controllers\API;

use App\Models\Newsletter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
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
        //
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

    /**
     * Subscribe user to a specific website
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'website_id' => ['required', Rule::exists('websites', 'id')],
            'user_id' => ['required', Rule::exists('websites', 'id')],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $userId = $request->user_id;
            $websiteId = $request->website_id;

            $userSubscription = Newsletter::where('user_id', $userId)->where('website_id', $websiteId)->first();

            // cannot subscribe, return already subscribed
            if ($userSubscription) {
                $response = array(
                    'data' => null,
                    'message' => 'User ' . $request->user_id . " already subscribed to website " . $request->website_id
                );

                return response()->json($response, 400);
            } else {
                $newsletter = new Newsletter();
                $newsletter->user_id = $request->user_id;
                $newsletter->website_id = $request->website_id;
                $newsletter->save();

                $response = array(
                    'data' => $newsletter,
                    'message' => 'Successfully created a subscription for user id ' . $request->user_id
                );

                return response()->json($response, 201);
            }
        }
    }
}
