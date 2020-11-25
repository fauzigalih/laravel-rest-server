<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Api;

class ApiController extends Controller
{
    public function index()
    {
        return view('api.index');
    }

    public function generate(Request $request) {
        Api::validateData($request);

        $key = Str::random(20);
        $generate = Api::create([
            'email' => $request->email,
            'key' => $key,
            'action' => implode(',', $request->action)
        ]);

        if ($generate) {
            return redirect('api')->with('success', 'Data created successfully! <br>
                                        Key: '. $key);
        }else{
            return redirect('api')->with('danger', 'Data failed to generate!');
        }
    }

    public function store(Request $request) 
    {
        if (!$request->key) {
            return Api::requiredKey();
        }else{
            if (!Api::foundKey($request)) return Api::invalidKey();
            if (!Api::actionKey($request, 'create')) return Api::blockAction();

            $model = Api::where('key', $request->key)->first();
            if ($request->name && $request->email && $request->phone) {
                if (User::where('email', 'like', '%' . $request->email . '%')->count() !== 0) {
                    return response()->json([
                        'status' => 'accept & canceled',
                        'to' => $model->email ?? null,
                        'message' => 'The email has already been taken.'
                    ], 403);
                }else{
                    $modelUserRequest = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone
                    ];
                    User::create($modelUserRequest);
                    return response()->json([
                        'status' => 'success',
                        'to' => $model->email ?? null,
                        'message' => 'Data created successfully.',
                        'data' => $modelUserRequest
                    ], 200);
                }
            }else{
                return Api::failedAction();
            }
        }
    }

    public function show(Request $request)
    {
        if (!$request->key) {
            return Api::requiredKey();
        }else{
            if (!Api::foundKey($request)) return Api::invalidKey();
            if (!Api::actionKey($request, 'read')) return Api::blockAction();

            $model = Api::where('key', $request->key)->first();
            if ($request->id) {
                return response()->json([
                    'status' => 'success',
                    'to' => $model->email ?? null,
                    'message' => 'Get single data user.',
                    'data' => User::where('id', $request->id)->first()
                ], 200);
            }else{
                return response()->json([
                    'status' => 'success',
                    'to' => $model->email ?? null,
                    'message' => 'Get all data user.',
                    'data' => User::all()
                ], 200);
            }
        }
    }
    
    public function update(Request $request)
    {
        if (!($request->key && $request->id)) {
            return Api::requiredKeyId();
        }else{
            if (!Api::foundKey($request)) return Api::invalidKey();
            if (!Api::actionKey($request, 'update')) return Api::blockAction();

            $model = Api::where('key', $request->key)->first();
            $modelUser = User::findOrFail($request->id);
            $modelUserNow = User::findOrFail($request->id);
            if ($request->name && $request->email && $request->phone) {
                if ($modelUser->email !== $request->email) {
                    if (User::where('email', 'like', '%' . $request->email . '%')->count() !== 0) {
                        return response()->json([
                            'status' => 'accept & canceled asas',
                            'to' => $model->email ?? null,
                            'message' => 'The email has already been taken.'
                        ], 403);
                    }
                }else{
                    $modelUserRequest = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone
                    ];
                    $modelUserNow->update($modelUserRequest);
                    return response()->json([
                        'status' => 'success',
                        'to' => $model->email ?? null,
                        'message' => 'Data updated successfully.',
                        'data' => [
                            'before' => [
                                'name' => $modelUser->name,
                                'email' => $modelUser->email,
                                'phone' => $modelUser->phone
                            ],
                            'after' => $modelUserRequest
                        ]
                    ], 200);
                }
            }else{
                return Api::failedAction();
            }
        }
    }
    
    public function destroy(Request $request)
    {
        if (!($request->key && $request->id)) {
            return Api::requiredKeyId();
        }else{
            if (!Api::foundKey($request)) return Api::invalidKey();
            if (!Api::actionKey($request, 'delete')) return Api::blockAction();
            
            if (User::where('id', $request->id)->count() !== 0) {
                $model = Api::where('key', $request->key)->first();
                $modelUser = User::findOrFail($request->id);
                $modelUserNow = User::findOrFail($request->id);
                $modelUserNow->delete();

                return response()->json([
                    'status' => 'success',
                    'to' => $model->email ?? null,
                    'message' => 'Data deleted successfully.',
                    'data' => $modelUser
                ], 200);
            }else{
                return Api::failedAction(404);
            }
        }
    }
}
