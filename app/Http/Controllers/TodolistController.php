<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TodolistController extends Controller
{
    public function getAll(Request $req)
    {
        $id = Auth::id();
        $res = Todolist::where('user_id', $id)->get();
        return response()->json($res);
    }

    public function add(Request $req)
    {
        $id = Auth::id();

        $title = htmlspecialchars($req->input('title'));
        $content = htmlspecialchars($req->input('content'));

        $validate = Validator::make([
            'title' => $title,
            'content' => $content
        ], [
            'title' => ['required'],
            'content' => ['required']
        ], [
            'title' => [
                'required' => 'Must be Filled'
            ],
            'content' => [
                'required' => 'Must be Filled'
            ]
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors()->first()
            ], 400);
        }

        Todolist::create([
            'content' => $content,
            'title' => $title,
            'user_id' => $id,
            'created_at' => Carbon::now(),
            'is_done' => false
        ]);

        return response()->json(["message" => "success"], 200);
    }

    public function update(Request $req)
    {
        $user_id = Auth::id();

        $title = htmlspecialchars($req->input('title'));
        $content = htmlspecialchars($req->input('content'));
        $id = intval($req->input('id'));

        $validate = Validator::make([
            'title' => $title,
            'content' => $content,
            'id' => $id
        ], [
            'title' => ['required'],
            'content' => ['required'],
            'id' => ['required', 'integer']
        ], [
            'title' => [
                'required' => 'Must be Filled'
            ],
            'content' => [
                'required' => 'Must be Filled'
            ],
            'id' => [
                'required' => 'Invalid ID',
                'integer' => 'Invalid ID'
            ]
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors()->first()
            ], 400);
        }

        $temp = Todolist::where('id', $id)->where('user_id', $user_id)->first();
        $temp->title = $title;
        $temp->content = $content;
        $temp->save();

        return response()->json(["message" => "success"], 200);
    }

    public function delete(Request $req)
    {
        $user_id = Auth::id();
        $id = intval($req->input('id'));

        $validate = Validator::make([
            'id' => $id
        ], [
            'id' => ['required', 'integer']
        ], [
            'id' => [
                'required' => 'Invalid ID',
                'integer' => 'Invalid ID'
            ]
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors()->first()
            ], 400);
        }
        Todolist::where('id', $id)->where('user_id', $user_id)->delete();
        return response()->json(["message" => "success"], 200);
    }

    public function toggle(Request $req)
    {
        $user_id = Auth::id();
        $id = intval($req->input('id'));

        $validate = Validator::make([
            'id' => $id
        ], [
            'id' => ['required', 'integer']
        ], [
            'id' => [
                'required' => 'Invalid ID',
                'integer' => 'Invalid ID'
            ]
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors()->first()
            ], 400);
        }

        $temp = Todolist::where('id', $id)->where('user_id', $user_id)->first();

        $temp->is_done = !$temp->is_done;
        $temp->save();

        return response()->json(["message" => "success"], 200);
    }
}
