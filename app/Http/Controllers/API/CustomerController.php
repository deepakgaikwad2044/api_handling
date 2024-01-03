<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CustomerController extends Controller
{


    public function index(){

        

 try{
 $customers = Customer::all();
 }catch(\Exception $e){
    $customers = null;
 }

 if($customers == null){
     return response()->json([
      "status"=>0,
    "message"=>"internal server error"
] , 500);


 }else{
 return response()->json([
      "status"=>1 ,
    "users"=>$customers
] , 200);

 }

    }


    public function store(Request $request){

        $validate = Validator::make($request->all() , [
            "name"=>"required|string|min:3|max:100" ,
            "email"=>"required|string|email|max:100|unique:customers" ,
            "password"=>"required|string|min:8",
            "confirm_password"=> "required|same:password"

        ]);

        if($validate->fails()){
            return response()->json([
                "errors"=> $validate->errors() ,
                "status"=>0 ,
                "res_code"=>400

            ], 400);
        }else{

            DB::beginTransaction();

            $data = [
                "name"=> $request->name ,
                "email"=> $request->email,
                "password"=> Hash::make($request->password)
            ];


            try{
                $user = Customer::create($data);
                DB::commit();
            }catch(\Exception $e){
                DB::rollBack();
                $user = null;
            }

            if($user != null){
                return  response()->json([
                    "message"=>"user successfully created" ,
                    "status"=> 1 ,
                ] , 200);
            }else{
                return response()->json([
                    "message"=>"Internal server error" ,
                    "status"=> 0 ,
                    "get_errors"=> $e->getMessage()
                ] , 500);
            }

        }


    }


}
