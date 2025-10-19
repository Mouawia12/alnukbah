<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->orderByDesc('id')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::orderBy('id')->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:6',
            'avatar' => 'nullable|image|max:2048',
            'role_id' => 'required|exists:roles,id',
        ]);

        // الصورة
        $path = 'users/default.png';
        if ($request->hasFile('avatar')) {
            $folder = 'users/' . now()->format('F_Y');
            $filename = Str::uuid() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $path = $request->file('avatar')->storeAs($folder, $filename, 'public');
        }
        $data['avatar'] = $path;

        // كلمة المرور
        if (!empty($data['password'])) {
            $generatedPassword = null;
            $data['password'] = Hash::make($data['password']);
        } else {
            $generatedPassword = Str::random(10);
            $data['password'] = Hash::make($generatedPassword);
        }

        // إنشاء المستخدم
        User::create($data);

        // الرسائل
        $redirect = redirect()->route('admin.users.index')->with('ok', '✅ تمت إضافة المستخدم بنجاح');
        if ($generatedPassword) {
            $redirect->with('generated_password', $generatedPassword);
        }
        return $redirect;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('id')->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$id}",
            'password' => 'nullable|string|min:6',
            'avatar' => 'nullable|image|max:2048',
            'role_id' => 'required|exists:roles,id',
        ]);

        // تحديث الصورة
        if ($request->hasFile('avatar')) {
            if ($user->avatar && $user->avatar !== 'users/default.png' && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $folder = 'users/' . now()->format('F_Y');
            $filename = Str::uuid() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $data['avatar'] = $request->file('avatar')->storeAs($folder, $filename, 'public');
        }

        // كلمة المرور
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('ok', '✅ تم تحديث المستخدم بنجاح');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->avatar && $user->avatar !== 'users/default.png' && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('ok', '🗑️ تم حذف المستخدم بنجاح');
    }
}
