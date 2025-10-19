@extends('admin.layouts.app')

@section('title', 'إضافة مقال')

@push('styles')
<style>
    /* 🎨 تنسيق المحرر CKEditor */
    .ck-content {
        color: #111 !important;
    }

    /* العناوين تبقى بنفس اللون الأسود */
    .ck-content h1,
    .ck-content h2,
    .ck-content h3,
    .ck-content h4,
    .ck-content h5,
    .ck-content h6 {
        color: #111 !important;
        font-weight: bold;
    }

    .ck.ck-editor__main > .ck-editor__editable {
        min-height: 300px;
        background-color: #fff;
        color: #111 !important;
        border-radius: 0.75rem;
        padding: 1rem;
    }
</style>
@endpush

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">إضافة مقال</h1>
        <p class="text-slate-400 mt-1">أنشئ مقالك مع محرر منسّق كامل</p>
    </div>
    <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700">
        الرجوع
    </a>
</div>

<div class="bg-slate-800/50 border border-slate-700 rounded-2xl shadow-soft p-6 space-y-8">
    @if ($errors->any())
        <div class="rounded-lg border border-red-500/50 bg-red-500/10 p-4">
            <div class="font-bold mb-2 text-red-300">حدثت أخطاء:</div>
            <ul class="list-disc pr-6 text-red-400">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid gap-4 md:grid-cols-2">
        <div class="rounded-2xl border border-slate-700 bg-slate-900/60 p-5">
            <p class="text-sm text-slate-400 mb-2 flex items-center gap-2">
                <i data-lucide="activity" class="w-4 h-4 text-emerald-400"></i>
                نسبة قبول السيو
            </p>
            <div class="flex items-center justify-between">
                <div class="flex items-baseline gap-3">
                    <span id="seoScoreValue" class="text-3xl font-extrabold text-emerald-400">0%</span>
                    <span id="seoScoreLabel" class="text-sm text-slate-400">ابدأ بإدخال المحتوى</span>
                </div>
                <span class="text-xs text-slate-500">يعتمد على العنوان، الكلمات المفتاحية، عدد الكلمات والصور.</span>
            </div>
            <div class="mt-4 h-2 w-full rounded-full bg-slate-800">
                <div id="seoScoreBar" class="h-2 rounded-full bg-emerald-500 transition-all duration-300" style="width:0%"></div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-700 bg-slate-900/60 p-5">
            <p class="text-sm text-slate-400 mb-2 flex items-center gap-2">
                <i data-lucide="calendar" class="w-4 h-4 text-sky-400"></i>
                تاريخ إنشاء المقال
            </p>
            <p class="text-lg font-semibold text-slate-100">سيتم تحديده تلقائياً بعد حفظ المقال.</p>
            <p class="text-sm text-slate-500 mt-2">سيُعرض التاريخ والوقت هنا بعد إنشاء المقال.</p>
        </div>
    </div>

    <form id="articleForm" method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- العنوان --}}
        <div>
            <label class="block mb-2 text-sm text-slate-300">العنوان *</label>
            <input id="titleInput" name="title" type="text" required
                class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="اكتب عنوان المقال" value="{{ old('title') }}">
        </div>

        {{-- الغلاف --}}
        <div>
            <label class="block mb-2 text-sm text-slate-300">صورة الغلاف *</label>
            <div class="w-full sm:w-80">
                <div class="h-40 w-full rounded-xl border border-dashed border-slate-700 flex items-center justify-center text-slate-400">
                    لا توجد صورة بعد
                </div>
                <div class="mt-3 flex items-center gap-3">
                    <button type="button"
                            class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white flex items-center gap-2"
                            onclick="document.getElementById('coverInput').click()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M12 5v14M5 12h14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        اختر صورة
                    </button>
                    <span id="coverFileHint" class="text-sm text-slate-400"></span>
                </div>
                <input id="coverInput" name="image" type="file" accept="image/*" required class="hidden">
                <p class="text-xs text-slate-500 mt-2">الحد الأقصى 4MB</p>
            </div>
        </div>

        {{-- المحتوى --}}
        <div>
            <div class="flex items-center justify-between mb-2">
                <label class="block text-sm text-slate-300">المحتوى</label>
                <span class="text-xs text-slate-400">الكلمات: <span id="wordCount">0</span></span>
            </div>
            <textarea id="editor" name="description">{{ old('description') }}</textarea>
        </div>

        {{-- ✅ صندوق مساعد السيو --}}
        <div id="seoAssistant" data-initial-cover="0" class="bg-slate-900/60 border border-slate-700 rounded-2xl px-5 py-6 space-y-4" dir="rtl">
            <h2 class="text-lg font-bold text-slate-100 flex items-center gap-2">
                <i data-lucide="sparkles" class="w-5 h-5 text-emerald-400"></i>
                مساعد السيو
            </h2>

            <div>
                <label class="block mb-2 text-sm text-slate-300">الكلمة المفتاحية الرئيسية</label>
                <input id="seoKeyword" type="text"
                    class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    placeholder="أدخل الكلمة المفتاحية المستهدفة">
            </div>

            <div class="grid gap-3 md:grid-cols-2" id="seoInsights">
                <div class="rounded-xl border border-slate-700 bg-slate-800/60 p-4 flex items-start gap-3">
                    <div class="status-indicator w-2 h-full rounded-full" data-check="titleKeyword"></div>
                    <div>
                        <p class="font-semibold text-slate-100">الكلمة المفتاحية في العنوان</p>
                        <p class="text-sm text-slate-400">هل يظهر المفتاح في العنوان؟</p>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-700 bg-slate-800/60 p-4 flex items-start gap-3">
                    <div class="status-indicator w-2 h-full rounded-full" data-check="titleLength"></div>
                    <div>
                        <p class="font-semibold text-slate-100">طول العنوان</p>
                        <p class="text-sm text-slate-400">العنوان المثالي بين 45 و 70 حرفًا.</p>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-700 bg-slate-800/60 p-4 flex items-start gap-3 md:col-span-2">
                    <div class="status-indicator w-2 h-full rounded-full" data-check="introKeyword"></div>
                    <div>
                        <p class="font-semibold text-slate-100">الكلمة المفتاحية في بداية المحتوى</p>
                        <p class="text-sm text-slate-400">يفضل ذكر الكلمة المفتاحية في أول فقرة.</p>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-700 bg-slate-800/60 p-4 flex items-start gap-3">
                    <div class="status-indicator w-2 h-full rounded-full" data-check="wordCount"></div>
                    <div>
                        <p class="font-semibold text-slate-100">عدد كلمات المحتوى</p>
                        <p class="text-sm text-slate-400">يفضل أن يزيد المقال عن 300 كلمة.</p>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-700 bg-slate-800/60 p-4 flex items-start gap-3">
                    <div class="status-indicator w-2 h-full rounded-full" data-check="coverImage"></div>
                    <div>
                        <p class="font-semibold text-slate-100">وجود صورة مميزة</p>
                        <p class="text-sm text-slate-400">أضف صورة غلاف واضحة وجذابة.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- معرض الصور الإضافية --}}
        <div>
            <label class="block mb-2 text-sm text-slate-300">إضافة صور للمعرض (اختياري)</label>
            <div class="flex items-center gap-3">
                <button type="button"
                        class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white flex items-center gap-2"
                        onclick="document.getElementById('galleryInput').click()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M12 5v14M5 12h14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    اختر الصور
                </button>
                <span id="galleryFilesHint" class="text-sm text-slate-400"></span>
            </div>
            <input id="galleryInput" type="file" name="gallery[]" multiple accept="image/*" class="hidden">
            <p class="text-xs text-slate-500 mt-2">يمكنك اختيار أكثر من صورة (كل صورة ≤ 4MB)</p>
        </div>

        {{-- الأزرار --}}
        <div class="pt-2 flex items-center gap-3">
            <button type="button" id="previewBtn" class="px-6 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 font-semibold">
                معاينة
            </button>
            <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">
                حفظ المقال
            </button>
        </div>
    </form>
</div>

{{-- مودال المعاينة --}}
<div id="previewModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative mx-auto my-10 w-[96%] max-w-4xl bg-slate-950 border border-slate-800 rounded-2xl shadow-2xl">
        <div class="flex items-center justify-between p-4 border-b border-slate-800">
            <h3 class="text-lg font-bold">معاينة المقال</h3>
            <button id="closePreview" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700">إغلاق</button>
        </div>
        <div class="p-6">
            <h1 id="pvTitle" class="text-2xl font-extrabold mb-4"></h1>
            <article id="pvContent" class="prose prose-invert max-w-none"></article>
        </div>
        <div class="p-4 border-t border-slate-800 text-left">
            <button id="closePreview2" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500">تم</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const removed = [
        'CKFinder','CKFinderUploadAdapter','EasyImage','ImageUpload','ImageInsert','MediaEmbed','CKBox',
        'RealTimeCollaborativeComments','RealTimeCollaborativeTrackChanges','RealTimeCollaborativeRevisionHistory',
        'PresenceList','Comments','TrackChanges','TrackChangesData','RevisionHistory','ExportPdf','ExportWord','AIAssistant',
        'WProofreader','SlashCommand','Template','DocumentOutline','WordCount','FormatPainter','Mention',
        'Pagination','CaseChange','PasteFromOfficeEnhanced','TableOfContents','MultiLevelList','TodoList'
    ];

    const toolbarItems = [
        'heading','|','bold','italic','underline','strikethrough','|',
        'fontSize','fontFamily','fontColor','fontBackgroundColor',
        'highlight','|','alignment','|','bulletedList','numberedList','|',
        'outdent','indent','|','link','blockQuote','insertTable','horizontalLine','specialCharacters','|','undo','redo'
    ];

    const countWords = (html) => {
        const d = document.createElement('div');
        d.innerHTML = html || '';
        const t = (d.textContent || '').trim();
        return (t.match(/[\u0600-\u06FF\w’'-]+/g) || []).length;
    };

    CKEDITOR.ClassicEditor.create(document.getElementById('editor'), {
        language: 'ar',
        toolbar: { items: toolbarItems },
        removePlugins: removed,

        /* ✅ إصلاح الروابط: يضيف https:// تلقائياً */
        link: {
            addTargetToExternalLinks: false,
            decorators: {
                openInNewTab: false
            },
            defaultProtocol: 'https://'
        },

        /* ✅ السماح بجميع الوسوم */
        htmlSupport: {
            allow: [{ name: /.*/, attributes: true, classes: true, styles: true }],
            disallow: []
        },

        htmlEmbed: { showPreviews: true }
    }).then(ed => {
        ed.model.document.on('change:data', () => {
            document.getElementById('wordCount').textContent = countWords(ed.getData());
        });

        document.getElementById('previewBtn').addEventListener('click', () => {
            document.getElementById('pvTitle').textContent = document.getElementById('titleInput').value || '— بدون عنوان —';
            document.getElementById('pvContent').innerHTML = ed.getData() || '<p class="text-slate-400">لا يوجد محتوى.</p>';
            document.getElementById('previewModal').classList.remove('hidden');
        });

        document.getElementById('closePreview').onclick = () => document.getElementById('previewModal').classList.add('hidden');
        document.getElementById('closePreview2').onclick = () => document.getElementById('previewModal').classList.add('hidden');

        attachSEOAssistant(ed);
    });

    // 🖼️ عرض أسماء الملفات المختارة
    const ci = document.getElementById('coverInput'), ch = document.getElementById('coverFileHint');
    ci?.addEventListener('change', () => { ch.textContent = ci.files.length ? ci.files[0].name : ''; });

    const gi = document.getElementById('galleryInput'), gh = document.getElementById('galleryFilesHint');
    gi?.addEventListener('change', () => {
        if (gi.files.length === 0) { gh.textContent = ''; return; }
        gh.textContent = gi.files.length === 1 ? 'تم اختيار ملف واحد.' : `تم اختيار ${gi.files.length} ملفات.`;
    });

    const seoIndicators = document.querySelectorAll('.status-indicator');
    const keywordInput = document.getElementById('seoKeyword');
    const titleInput = document.getElementById('titleInput');
    const coverInput = document.getElementById('coverInput');
    const seoAssistant = document.getElementById('seoAssistant');
    const seoScoreValue = document.getElementById('seoScoreValue');
    const seoScoreBar = document.getElementById('seoScoreBar');
    const seoScoreLabel = document.getElementById('seoScoreLabel');
    let hasInitialCover = seoAssistant?.dataset.initialCover === '1';

    const colorClasses = ['bg-emerald-500', 'bg-amber-500', 'bg-rose-500', 'bg-slate-700'];
    const baseIndicatorClasses = ['status-indicator', 'w-2', 'h-full', 'rounded-full'];

    const setIndicator = (name, status) => {
        const indicator = document.querySelector(`.status-indicator[data-check="${name}"]`);
        if (!indicator) return;
        baseIndicatorClasses.forEach(cls => indicator.classList.add(cls));
        colorClasses.forEach(cls => indicator.classList.remove(cls));
        const colors = {
            good: 'bg-emerald-500',
            medium: 'bg-amber-500',
            bad: 'bg-rose-500',
            neutral: 'bg-slate-700'
        };
        indicator.classList.add(colors[status] ?? colors.neutral);
    };

    const updateSeoScore = (statuses) => {
        if (!seoScoreValue || !seoScoreBar) return;

        const keys = ['titleKeyword', 'titleLength', 'introKeyword', 'wordCount', 'coverImage'];
        let score = 0;

        keys.forEach(key => {
            const status = statuses[key] ?? 'neutral';
            if (status === 'good') score += 20;
            else if (status === 'medium') score += 10;
        });

        seoScoreValue.textContent = `${score}%`;
        const barWidth = Math.min(100, Math.max(0, score));
        seoScoreBar.style.width = `${barWidth}%`;

        const stateOptions = [
            { min: 80, bar: 'bg-emerald-500', text: 'text-emerald-400', label: 'ممتاز' },
            { min: 60, bar: 'bg-emerald-400', text: 'text-emerald-300', label: 'جيد' },
            { min: 40, bar: 'bg-amber-500', text: 'text-amber-400', label: 'متوسط' },
            { min: 0,  bar: 'bg-rose-500', text: 'text-rose-400', label: 'ضعيف' },
        ];

        const allNeutral = keys.every(key => (statuses[key] ?? 'neutral') === 'neutral');

        ['bg-emerald-500','bg-emerald-400','bg-amber-500','bg-rose-500','bg-slate-700'].forEach(cls => seoScoreBar.classList.remove(cls));
        ['text-emerald-400','text-emerald-300','text-amber-400','text-rose-400','text-slate-300'].forEach(cls => seoScoreValue.classList.remove(cls));

        if (allNeutral) {
            seoScoreBar.classList.add('bg-slate-700');
            seoScoreValue.classList.add('text-slate-300');
            if (seoScoreLabel) seoScoreLabel.textContent = 'ابدأ بإدخال المحتوى';
            return;
        }

        const selected = stateOptions.find(option => score >= option.min) || stateOptions[stateOptions.length - 1];

        seoScoreBar.classList.add(selected.bar);
        seoScoreValue.classList.add(selected.text);

        if (seoScoreLabel) {
            seoScoreLabel.textContent = selected.label;
        }
    };

    const evaluateSEO = (editorInstance) => {
        if (!keywordInput || !titleInput || !seoIndicators.length) return;
        const keyword = (keywordInput.value || '').trim();
        const title = (titleInput.value || '').trim();
        const descriptionHTML = editorInstance.getData() || '';
        const parser = document.createElement('div');
        parser.innerHTML = descriptionHTML;
        const paragraphs = Array.from(parser.querySelectorAll('p'));
        const firstParagraphText = (paragraphs[0]?.textContent || '').trim();
        const plainText = (parser.textContent || '').trim();
        const wordMatches = plainText.match(/[\u0600-\u06FF\w’'-]+/g) || [];
        const wordTotal = wordMatches.length;

        const statuses = {
            titleKeyword: 'neutral',
            introKeyword: 'neutral',
            titleLength: 'neutral',
            wordCount: 'neutral',
            coverImage: 'neutral',
        };

        if (!keyword) {
            setIndicator('titleKeyword', 'neutral');
            setIndicator('introKeyword', 'neutral');
        } else {
            const titleHasKeyword = title.includes(keyword);
            const introHasKeyword = firstParagraphText.includes(keyword);
            statuses.titleKeyword = titleHasKeyword ? 'good' : 'bad';
            statuses.introKeyword = introHasKeyword ? 'good' : 'bad';
            setIndicator('titleKeyword', statuses.titleKeyword);
            setIndicator('introKeyword', statuses.introKeyword);
        }

        if (!title) {
            setIndicator('titleLength', 'neutral');
        } else if (title.length < 30) {
            statuses.titleLength = 'bad';
            setIndicator('titleLength', 'bad');
        } else if (title.length <= 70) {
            statuses.titleLength = 'good';
            setIndicator('titleLength', 'good');
        } else {
            statuses.titleLength = 'medium';
            setIndicator('titleLength', 'medium');
        }

        if (wordTotal === 0) {
            setIndicator('wordCount', 'neutral');
        } else if (wordTotal < 200) {
            statuses.wordCount = 'bad';
            setIndicator('wordCount', 'bad');
        } else if (wordTotal < 300) {
            statuses.wordCount = 'medium';
            setIndicator('wordCount', 'medium');
        } else {
            statuses.wordCount = 'good';
            setIndicator('wordCount', 'good');
        }

        const hasCover = (coverInput?.files.length || 0) > 0 || hasInitialCover;
        statuses.coverImage = hasCover ? 'good' : 'bad';
        setIndicator('coverImage', statuses.coverImage);

        updateSeoScore(statuses);
    };

    const attachSEOAssistant = (instance) => {
        if (!keywordInput || !titleInput) return;
        evaluateSEO(instance);
        keywordInput.addEventListener('input', () => evaluateSEO(instance));
        titleInput.addEventListener('input', () => evaluateSEO(instance));
        coverInput?.addEventListener('change', () => {
            if ((coverInput.files.length || 0) > 0) {
                hasInitialCover = true;
            }
            evaluateSEO(instance);
        });
        instance.model.document.on('change', () => evaluateSEO(instance));
    };

});
</script>
@endpush
