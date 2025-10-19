<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPasswordController extends Controller
{
    /**
     * Show the password change form for the authenticated admin.
     */
    public function edit()
    {
        return view('admin.auth.password');
    }

    /**
     * Handle the password update for the authenticated admin.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
        ], [
            'current_password.required' => 'يرجى إدخال كلمة المرور الحالية.',
            'password.required' => 'يرجى إدخال كلمة المرور الجديدة.',
            'password.min' => 'يجب أن تتكون كلمة المرور الجديدة من 8 أحرف على الأقل.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            'password.different' => 'يجب أن تكون كلمة المرور الجديدة مختلفة عن الحالية.',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()
                ->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة.'])
                ->withInput($request->except('current_password'));
        }

        $user->update([
            'password' => $validated['password'],
        ]);

        return back()->with('ok', '✅ تم تحديث كلمة المرور بنجاح.');
    }
}
