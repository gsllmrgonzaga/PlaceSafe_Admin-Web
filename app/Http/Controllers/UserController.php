<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use App\Models\User;





class UserController extends Controller

{

    public function change_password(Request $request) {

        $data = [];



        if($request->isMethod('post')) {

            $isPassed = Hash::check($request->password, Auth::user()->password);



            if($isPassed) {

                if(!empty($request->new_password) && $request->new_password === $request->confirm_password) {

                    User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->confirm_password)]);

                    $data['message'] = '<p class="alert alert-success mb-0">Successfully updated your password. Logout your account and login again.</p>';

                } else {

                    $data['message'] = '<p class="alert alert-danger mb-0">Please match your new password! New password cannot be empty also.</p>';

                }

            } else {

                $data['message'] = '<p class="alert alert-danger mb-0">Wrong input for current password!</p>';

            }

        }

        return view('changepassword', $data);

    }

}

