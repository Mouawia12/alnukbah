<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = Statistic::latest()->paginate(10);
        return view('admin.statistics.index', compact('statistics'));
    }

    public function create()
    {
        return view('admin.statistics.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'projects'   => 'required|integer|min:0',
            'client'     => 'required|integer|min:0',
            'employer'   => 'required|integer|min:0',
            'experience' => 'required|integer|min:0',
            'img1'       => 'nullable|mimes:jpeg,jpg,png,webp|max:4096',
            'img2'       => 'nullable|mimes:jpeg,jpg,png,webp|max:4096',
        ]);

        $folder = 'statistics/' . now()->format('F_Y');

        if ($request->hasFile('img1')) {
            $filename1 = Str::uuid() . '.' . $request->file('img1')->getClientOriginalExtension();
            $data['img1'] = $request->file('img1')->storeAs($folder, $filename1, 'public');
        }

        if ($request->hasFile('img2')) {
            $filename2 = Str::uuid() . '.' . $request->file('img2')->getClientOriginalExtension();
            $data['img2'] = $request->file('img2')->storeAs($folder, $filename2, 'public');
        }

        Statistic::create($data);

        Cache::forget('front.statistics');

        return redirect()->route('admin.statistics.index')->with('ok', '✅ تمت إضافة الإحصائيات بنجاح');
    }

    public function edit($id)
    {
        $stat = Statistic::findOrFail($id);
        return view('admin.statistics.edit', compact('stat'));
    }

    public function update(Request $request, $id)
    {
        $stat = Statistic::findOrFail($id);

        $data = $request->validate([
            'projects'   => 'required|integer|min:0',
            'client'     => 'required|integer|min:0',
            'employer'   => 'required|integer|min:0',
            'experience' => 'required|integer|min:0',
            'img1'       => 'nullable|mimes:jpeg,jpg,png,webp|max:4096',
            'img2'       => 'nullable|mimes:jpeg,jpg,png,webp|max:4096',
        ]);

        $folder = 'statistics/' . now()->format('F_Y');

        if ($request->hasFile('img1')) {
            if ($stat->img1 && Storage::disk('public')->exists($stat->img1)) {
                Storage::disk('public')->delete($stat->img1);
            }
            $filename1 = Str::uuid() . '.' . $request->file('img1')->getClientOriginalExtension();
            $data['img1'] = $request->file('img1')->storeAs($folder, $filename1, 'public');
        }

        if ($request->hasFile('img2')) {
            if ($stat->img2 && Storage::disk('public')->exists($stat->img2)) {
                Storage::disk('public')->delete($stat->img2);
            }
            $filename2 = Str::uuid() . '.' . $request->file('img2')->getClientOriginalExtension();
            $data['img2'] = $request->file('img2')->storeAs($folder, $filename2, 'public');
        }

        $stat->update($data);

        Cache::forget('front.statistics');

        return redirect()->route('admin.statistics.index')->with('ok', '✅ تم تحديث الإحصائيات بنجاح');
    }

    public function destroy($id)
    {
        $stat = Statistic::findOrFail($id);

        if ($stat->img1 && Storage::disk('public')->exists($stat->img1)) {
            Storage::disk('public')->delete($stat->img1);
        }
        if ($stat->img2 && Storage::disk('public')->exists($stat->img2)) {
            Storage::disk('public')->delete($stat->img2);
        }

        $stat->delete();

        Cache::forget('front.statistics');
        return redirect()->route('admin.statistics.index')->with('ok', '🗑️ تم حذف الإحصائيات بنجاح');
    }
}
