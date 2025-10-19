<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    // ✅ عرض جميع الاشتراكات
    public function index()
    {
        $subscribes = Subscribe::latest()->paginate(12);
        return view('admin.subscribes.index', compact('subscribes'));
    }

    // 🗑️ حذف اشتراك
    public function destroy($id)
    {
        $subscribe = Subscribe::findOrFail($id);
        $subscribe->delete();

        return redirect()->route('admin.subscribes.index')->with('ok', '🗑️ تم حذف الاشتراك بنجاح');
    }
}
