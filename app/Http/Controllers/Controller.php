<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Statistic;
use App\Models\Subscribe;
use App\Models\Subservice;
use App\Models\Work;
use App\Support\TextSanitizer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $sliders = Cache::remember('front.sliders', now()->addMinutes(15), fn () => Slider::query()->latest('id')->take(10)->get());
        $services = $this->cachedServices();
        $about = Cache::remember('front.about', now()->addMinutes(30), fn () => About::query()->first() ?? new About());
        $statistics = $this->cachedStatistics();
        $articles = Cache::remember('front.articles.latest', now()->addMinutes(15), fn () => Article::query()->latest('id')->take(9)->get());
        $works = Cache::remember('front.works.latest', now()->addMinutes(15), fn () => Work::query()->latest('id')->take(9)->get());
        $settings = Cache::remember('front.settings', now()->addMinutes(30), fn () => Setting::query()->orderBy('group')->get());

        return view('welcome', [
            'works' => $works,
            'Setting' => $settings,
            'sliders' => $sliders,
            'services' => $services,
            'abouts' => $about,
            'statistics' => $statistics,
            'articles' => $articles,
        ]);
    }

    public function service($id)
    {
        $services = $this->cachedServices();
        $servicedetail = Service::query()->with(['subservices' => fn ($query) => $query->orderBy('id')])->findOrFail($id);
        $statistics = $this->cachedStatistics();

        return view('service', [
            'servicedetail' => $servicedetail,
            'services' => $services,
            'statistics' => $statistics,
        ]);
    }

    public function subservice($id)
    {
        $services = $this->cachedServices();
        $subservicedetail = Subservice::query()->findOrFail($id);
        $statistics = $this->cachedStatistics();

        return view('subservice', [
            'subservicedetail' => $subservicedetail,
            'services' => $services,
            'statistics' => $statistics,
        ]);
    }

    public function article($id)
    {
        $services = $this->cachedServices();
        $article = Article::query()->findOrFail($id);
        $statistics = $this->cachedStatistics();

        return view('article', [
            'article' => $article,
            'services' => $services,
            'statistics' => $statistics,
        ]);
    }

    public function work($id)
    {
        $services = $this->cachedServices();
        $work = Work::query()->findOrFail($id);
        $statistics = $this->cachedStatistics();

        return view('work', [
            'work' => $work,
            'services' => $services,
            'statistics' => $statistics,
        ]);
    }

    public function articles()
    {
        $services = $this->cachedServices();
        $articles = Article::query()->latest('id')->paginate(9);
        $statistics = $this->cachedStatistics();

        return view('articles', [
            'articles' => $articles,
            'services' => $services,
            'statistics' => $statistics,
        ]);
    }

    public function contact()
    {
        $services = $this->cachedServices();
        $statistics = $this->cachedStatistics();

        return view('contact', [
            'services' => $services,
            'statistics' => $statistics,
        ]);
    }

    public function contactsend(Request $request)
    {
        $this->ensureIsNotRateLimited($request, 'contact');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'nullable|string|max:30',
            'location' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'location' => $data['location'] ?? null,
            'message' => TextSanitizer::clean($data['message']),
        ]);

        $this->hitRateLimiter($request, 'contact');

        return redirect()->back()->with('success', 'تم إرسال طلبك بنجاح');
    }

    public function subscribe(Request $request)
    {
        $this->ensureIsNotRateLimited($request, 'subscribe');

        $data = $request->validate([
            'email' => 'required|email:rfc,dns|max:255|unique:subscribes,email',
        ]);

        Subscribe::firstOrCreate(['email' => $data['email']]);

        $this->hitRateLimiter($request, 'subscribe');

        return redirect()->back()->with('success', 'تم الاشتراك بنجاح');
    }

    private function cachedServices()
    {
        return Cache::remember('front.services', now()->addMinutes(30), fn () => Service::query()->orderBy('id')->get());
    }

    private function cachedStatistics()
    {
        return Cache::remember('front.statistics', now()->addMinutes(30), fn () => Statistic::query()->first() ?? new Statistic());
    }

    private function ensureIsNotRateLimited(Request $request, string $prefix): void
    {
        $key = $this->rateLimitKey($request, $prefix);

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'rate_limit' => "لقد تجاوزت الحد المسموح للمحاولات. حاول مرة أخرى بعد {$seconds} ثانية.",
            ])->status(429);
        }
    }

    private function hitRateLimiter(Request $request, string $prefix): void
    {
        RateLimiter::hit($this->rateLimitKey($request, $prefix), 300);
    }

    private function rateLimitKey(Request $request, string $prefix): string
    {
        return sprintf('%s|%s', $prefix, $request->ip());
    }
}
