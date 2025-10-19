<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // ✅ عرض جميع الرسائل
    public function index()
    {
        $contacts = Contact::latest()->paginate(12);
        return view('admin.contacts.index', compact('contacts'));
    }

    // 📄 عرض تفاصيل رسالة واحدة
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    // 🗑️ حذف رسالة
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('ok', '🗑️ تم حذف الرسالة بنجاح');
    }
}
