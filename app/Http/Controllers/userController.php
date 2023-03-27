<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class userController extends Controller{
    public function show(Request $request){
        $request->validate([
            'email' => ['required', 'string'], 
            'password' => ['required', 'string'],
            'g-recaptcha-response' => function ($attribute, $value, $fail) {
                $secretKey = '6LeCEegiAAAAABXPSH4wHgbLUybKKECI10qUENsN';
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = \file_get_contents($url);
                $response = json_decode($response);
                if(!$response->success){
                    Session::flash('g-recaptcha-response', 'please check reCaptcha');
                    Session::flash('alert-class', 'alert-danger');
                    $fail($attribute.'google reCaptcha failed');
                }
            }
        ]);
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        $data = DB::table('users')->select('status')->where('email', $request->get('email'));
        if(Auth::attempt($credentials, $remember) and $data == TRUE){
            $request->session()->regenerate();
            return redirect('usuarios');
        }
        return redirect('login')->withSuccess('no se completo el inicio');
    }

    public function create(Request $request){
        $request->validate([
            'name' => ['string'],
            'email' => ['required', 'string'], 
            'password' => ['required', 'string', 'min:6'],
            'g-recaptcha-response' => function ($attribute, $value, $fail) {
                $secretKey = '6LeCEegiAAAAABXPSH4wHgbLUybKKECI10qUENsN';
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = \file_get_contents($url);
                $response = json_decode($response);
                if(!$response->success){
                    Session::flash('g-recaptcha-response', 'please check reCaptcha');
                    Session::flash('alert-class', 'alert-danger');
                    $fail($attribute.'google reCaptcha failed');
                }
            }
            
        ]);
        if ($request->hasFile('avatar')){

            $file = $request->file('avatar');
            $file_name_new = uniqid('',true);
            $path = "$file_name_new.png";
            $actualpath ="avatars/$path";
            $file->move('avatars', $path);
        }
        else {
            $actualpath = '/avatars/avatar.jfif';
        }

        if ($request->get('password') == $request->get('password2')){
            $credentials = $request->only('email', 'password');
            $data = $request->all();
            $urlImage = array('avatares' => $actualpath);
            $data = array_replace($data, $urlImage);
            $check = $this->creacion($data);
            if(Auth::attempt($credentials, false) and $data['Status'] == 'on'){
                $request->session()->regenerate();
                return redirect('usuarios');
            }
        }
        return redirect('register')->withSuccess('no se completo el registro');
    }

    public function creacion(array $data){
        if ($data['Status'] == "on"){
            $estado = TRUE;
        }else {
            $estado = FALSE;
        }
        return User::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $data['avatares'],
            'phone' => $data['phone'],
            'rol' => $data['rol'],
            'status' => $estado
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function editar($id) {
        $user = User::all($id);
        return view('usersdetail', compact('user'));
    }

    public function eliminar($id) {
        if ($id->is(auth()->id())) {
            User::destroy($id);
        }
        return redirect()->back();
    }

    public function actualizar(Request $request) {
        if ($request->hasFile('avatar')){

            $file = $request->file('avatar');
            $file_name_new = uniqid('',true);
            $path = "$file_name_new.png";
            $actualpath ="avatars/$path";
            $file->move('avatars', $path);
        }else {
            $actualpath = $request.get('avatar');
        }
        if ($data['Status'] == "on"){
            $estado = TRUE;
        }else {
            $estado = FALSE;
        }
        DB::table('users')->where('id', $request->get('id'))->update([
            'last_name' => $request->get('last_name'),
            'first_name' => $request->get('first_name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'avatar' => $actualpath,
            'phone' => $request->get('phone'),
            'rol' => $request->get('rol'),
            'status' => $estado
        ]);
        return redirect()->back();
    }

    public function registrar(Request $request) {
        if ($request->hasFile('avatar')){

            $file = $request->file('avatar');
            $file_name_new = uniqid('',true);
            $path = "$file_name_new.png";
            $actualpath ="avatars/$path";
            $file->move('avatars', $path);
        }
        else {
            $actualpath = '/avatars/avatar.jfif';
        }
        $data = $request->all();
        $urlImage = array('avatares' => $actualpath);
        $data = array_replace($data, $urlImage);
        $check = $this->creacion($data);

        return redirect()->back();
    }
}
