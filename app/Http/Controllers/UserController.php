<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CourseRegister;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $paginate=20;
    public function index($id)    {
        $users = User::find($id);

        if (!$users) {
            return abort(404);
        }

        return view('Profile.profile', compact('users'));
    }


    public function history($id)    {
        $users = User::find($id);

        if (!$users) {
            return abort(404);
        }

        $CourseRegister=CourseRegister::where('user_id',$id)->orderBy('doc_no')->paginate($this->paginate);
        return view('Profile.history', compact('users','CourseRegister'));
    }


    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'img' => 'required|string',
            'price' => 'required|numeric',
        ]);


        $users = new User($validatedData);
        $users->save();

        return redirect('/products')->with('success', 'อัพโหลดเรียบร้อยแล้ว!');
    }


    public function uploadProfile(Request $request)
    {

        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:5096',
        ]);

        $imagePath = $request->file('img')->store('profile_images', 'public');
        auth()->user()->update([
            'img' => $imagePath,
        ]);

        return redirect()->route('Profile.uploadProfile', ['id' => auth()->user()->id])
            ->with('success', 'อัพโหลดรูปโปรไฟล์เรียบร้อยแล้ว!');
    }

    public function editProfile(Request $request, $id)
    {
        // dd($request->all());
        // dd( $id);
        // dd($request->all());

        $request->validate([
            'user_name' => 'required',
            'user_firstname' => 'required',
            'user_lastname' => 'required',
            'user_email' => 'required|email',
            'user_address' => 'required',
            'user_tel' => 'required',
            'user_birthdate' => 'required|date',
        ]);


        auth()->user()->update([
            'name' => $request->input('user_name'),
            'firstname' => $request->input('user_firstname'),
            'lastname' => $request->input('user_lastname'),
            'email' => $request->input('user_email'),
            'address' => $request->input('user_address'),
            'tel' => $request->input('user_tel'),
            'birthdate' => $request->input('user_birthdate'),
        ]);

        // $users->save();

        return redirect()->route('user.profile', ['id' => auth()->user()->id])->with('success', 'แก้ไขข้อมูลเสร็จสิ้น!');
    }

}
