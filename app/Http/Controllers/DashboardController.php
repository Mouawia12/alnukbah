<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Service;
use App\Models\Work;
use App\Models\User;
use App\Models\Contact;
use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        // 🧮 الإحصائيات العامة
        $stats = [
            'articles'   => Article::count(),
            'services'   => Service::count(),
            'works'      => Work::count(),
            'users'      => User::count(),
            'contacts'   => Contact::count(),
            'subscribes' => Subscribe::count(),
        ];

        // 🕒 آخر 5 عناصر من كل نوع
        $latestArticles   = Article::latest()->take(5)->get(['id', 'title', 'created_at']);
        $latestContacts   = Contact::latest()->take(5)->get(['id', 'name', 'email', 'created_at']);
        $latestSubscribes = Subscribe::latest()->take(5)->get(['id', 'email', 'created_at']);

        // 📅 آخر 30 يوم (نشاط يومي)
        $days = collect(range(29, 0))->map(function ($i) {
            $date = Carbon::now()->subDays($i)->startOfDay();
            return [
                'key'   => $date->format('Y-m-d'),
                'label' => $date->locale('ar')->translatedFormat('d M'),
            ];
        });

        // 🧩 دالة مساعدة لحساب العدد اليومي لأي موديل
        $getDailyData = function ($model) {
            return $model::query()
                ->where('created_at', '>=', Carbon::now()->subDays(29)->startOfDay())
                ->selectRaw('DATE(created_at) as d, COUNT(*) as total')
                ->groupBy('d')
                ->orderBy('d')
                ->pluck('total', 'd'); // ['2025-10-01' => 4, ...]
        };

        // 📊 البيانات اليومية لكل قسم
        $dailyArticles = $getDailyData(Article::class);
        $dailyServices = $getDailyData(Service::class);
        $dailyWorks    = $getDailyData(Work::class);

        // 🧾 ملء الأيام الفارغة بالقيم 0
        $chartLabels = $days->pluck('label')->values();
        $chartValues = [
            'articles' => $days->map(fn($d) => (int) ($dailyArticles[$d['key']] ?? 0))->values(),
            'services' => $days->map(fn($d) => (int) ($dailyServices[$d['key']] ?? 0))->values(),
            'works'    => $days->map(fn($d) => (int) ($dailyWorks[$d['key']] ?? 0))->values(),
        ];

        // 🔍 تحليل إضافي بسيط
        $articlesWithImages    = Article::whereNotNull('image')->count();
        $articlesWithoutImages = Article::whereNull('image')->count();
        $articlesWithGallery   = Article::whereNotNull('images')->count();
        $articlesWithoutDesc   = Article::whereNull('description')->orWhere('description', '')->count();
        $articlesThisMonth     = Article::whereMonth('created_at', now()->month)->count();

        // 🔁 تمرير كل البيانات إلى الواجهة
        return view('admin.dashboard.index', [
            'stats'                => $stats,
            'chartLabels'          => $chartLabels,
            'chartValues'          => $chartValues,
            'latestArticles'       => $latestArticles,
            'latestContacts'       => $latestContacts,
            'latestSubscribes'     => $latestSubscribes,
            'articlesCount'        => $stats['articles'],
            'articlesWithImages'   => $articlesWithImages,
            'articlesWithoutImages'=> $articlesWithoutImages,
            'articlesWithGallery'  => $articlesWithGallery,
            'articlesWithoutDesc'  => $articlesWithoutDesc,
            'articlesThisMonth'    => $articlesThisMonth,
        ]);
    }
}
