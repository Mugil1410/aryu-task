<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
 

class UserController extends Controller
{   

    public function home(){
        return view('welcome');
    }
    
    public function index(){
        $user = User::all();
        return response()->json(['user'=> $user]);; 
    }

    public function add(Request $request){
        $request->validate([
           'firstname'=>'required',
           'lastname'=>'required',
           'phone'=>'required',
           'email'=>'required',
           'comment'=>'required']); 
       $user= new User();
       $user->firstname=$request->input('firstname');
       $user->lastname=$request->input('lastname');
       $user->phone=$request->input('phone');
       $user->email=$request->input('email');
       $user->comment=$request->input('comment');
       $user->date=date('Y-m-d');
       $user->save();
       return response()->json(['user'=> $user]);
    }


    public function datefilter(Request $request){
        $request->validate([
            'fromdate'=>'required',
           ]); 

            $fromdate = $request->input('fromdate');
           
            $user = User::where('date','LIKE',"%{$fromdate}%")->get();
        ;
            return response()->json(['user'=> $user,]);
    }

    /* public function edit($id){
            $user = User::find($id);
            return response()->json(['user'=> $user,]);;
        
    }

    public function update(Request $request,$id){
      $user = User::find($id);
      $user -> name = request('name');
      $user -> email = request('email');
      $user->update();
      return response()->json(['user'=> $user,]);
    }

    public function delete(Request $request, $id){
        if($request->ajax()){
            $user = User::find($id);
            $user->delete();
            return response()->json(['user'=>$user,'message'=>"User Deleted Successfully"]);
        }else{
            return response()->json(['message'=>"User Delete function failed"]);
        }
    } */
}
