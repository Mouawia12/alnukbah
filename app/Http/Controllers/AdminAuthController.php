<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;


class AdminAuthController extends Controller
{
    public function showLogin()
    {
        // لو المستخدم مُسجّل دخوله بالفعل، يروح للداشبورد
        if (Auth::check()) {
            $Setting=Setting::all();
            return redirect()->route('admin.dashboard')->with('Setting',$Setting);
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => 'البريد الإلكتروني مطلوب',
            'email.email'       => 'صيغة البريد غير صحيحة',
            'password.required' => 'كلمة المرور مطلوبة',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $Setting=Setting::all();
            // ✅ بعد تسجيل الدخول، تحويل مباشر إلى لوحة التحكم
            return redirect()->intended(route('admin.dashboard'))->with('Setting',$Setting)->with('ok', 'مرحباً بك 👋');
        }

        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('ok', 'تم تسجيل الخروج بنجاح');
    }
}
