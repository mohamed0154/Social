<?php
namespace App\Traits;

use App\Models\User;

trait AuthUser{

    public function sign_up($request){
        try{
            if(isset($request) && $request != null){
                User::create($request->all());
                return redirect(route('login'))->with('success','You can log in now');
            }
        }catch(\Exception $ex){
           // return $ex;
            return redirect()->back()->with('error','Error');
        }

    }

}
