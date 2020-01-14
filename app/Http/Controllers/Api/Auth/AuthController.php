<?php

namespace App\Http\Controllers\Api\Auth;


use App\Temp001;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;



class AuthController extends Controller
{

        public $successStatus = 200;

        /**
         * login api
         *
         * @return \Illuminate\Http\Response
         */
        public function login(){

        //     $validator = Validator::make($request->all(), [
        //         'email' => 'required|email',
        //         'password' => 'required|min:8|max:20'
        //     ],
        //     [
        //         'email.required'=>'邮箱不存在',
        //         'min:'=>'只少是8个字符'
        //     ]
        // );

            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
                $user = Auth::user();
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $success['user']  = Auth::user();

                $model = new Temp001();
                $model = $model->where('tag1', '人员分组');
                $model = $model->get();
                $success['model']  = $model;

                return response()->json(
                    [
                        'data' => $success,
                        'code'=>$this->successStatus,
                        'message'=>'登录成功'
                    ],
                    $this->successStatus
                );
            }
            else{

                return response()->json(['message'=>'账号登录失败!','code'=>401
            ], 401);
            }
        }

        /**
         * Register api
         *
         * @return \Illuminate\Http\Response
         */
        // public function register(Request $request)
        // {
        //     $validator = Validator::make($request->all(), [
        //         'name' => 'required',
        //         'email' => 'required|email',
        //         'password' => 'required',
        //         'c_password' => 'required|same:password',
        //     ]);

        //     if ($validator->fails()) {
        //         return response()->json(['error'=>$validator->errors()], 401);
        //     }

        //     $input = $request->all();
        //     $input['password'] = bcrypt($input['password']);
        //     $user = User::create($input);
        //     $success['token'] =  $user->createToken('MyApp')->accessToken;
        //     $success['name'] =  $user->name;

        //     return response()->json(['success'=>$success], $this->successStatus);
        // }

        // /**
        //  * details api
        //  *
        //  * @return \Illuminate\Http\Response
        //  */
        // public function getDetails()
        // {
        //     $user = Auth::user();
        //     return response()->json(['success' => $user], $this->successStatus);
        // }

}
