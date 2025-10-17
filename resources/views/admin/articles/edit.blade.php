@extends('admin.layouts.app')

@section('title', 'تعديل مقال')

@push('styles')
<style>
    /* 🎨 تنسيق CKEditor */
    .ck-content {
        color: #111 !important;
    }
    .ck-content h1,
    .ck-content h2,
    .ck-content h3,
    .ck-content h4,
    .ck-content h5,
    .ck-content h6 {
        color: #111 !important; /* تبقى سوداء دائمًا */
        font-weight: bold;
    }
    .ck.ck-editor__main > .ck-editor__editable {
        min-height: 300px;
        background-color: #fff;
        color: #111 !important;
        border-radius: 0.75rem;
        padding: 1rem;
    }

    /* 🖼️ Lightbox */
    #galleryModal { background: rgba(0, 0, 0, .75); }
    #galleryModal .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        padding: .5rem .7rem;
        border-radius: .75rem;
        background: rgba(15, 23, 42, .7);
        border: 1px solid rgba(51, 65, 85, .7);
        transition: background .2s;
    }
    #galleryModal .nav-btn:hover { background: rgba(30, 41, 59, .9); }
    #galleryModal .close-btn {
        position: absolute;
        top: .75rem;
        right: .75rem;
        padding: .35rem .6rem;
        border-radius: .75rem;
        background: rgba(15, 23, 42, .7);
        border: 1px solid rgba(51, 65, 85, .7);
        transition: background .2s;
    }
    #galleryModal .close-btn:hover { background: rgba(30, 41, 59, .9); }
</style>
@endpush

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold">تعديل مقال</h1>
        <p class="text-slate-400 mt-1">قم بتعديل محتوى المقال</p>
    </div>
    <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700">الرجوع</a>
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

    <form id="articleForm" method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- العنوان --}}
        <div>
            <label class="block mb-2 text-sm text-slate-300">العنوان *</label>
            <input id="titleInput" name="title" type="text" required
                class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                value="{{ old('title', $article->title) }}">
        </div>

        {{-- الغلاف --}}
        <div>
            <label class="block mb-2 text-sm text-slate-300">صورة الغلاف</label>
            <div class="w-full sm:w-80">
                @if($article->image)
                    <img src="{{ asset('storage/'.$article->image) }}" class="h-40 w-full object-cover rounded-xl border border-slate-700">
                @else
                    <div class="h-40 w-full rounded-xl border border-dashed border-slate-700 flex items-center justify-center text-slate-400">
                        لا توجد صورة
                    </div>
                @endif
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
                <input id="coverInput" name="image" type="file" accept="image/*" class="hidden">
                <p class="text-xs text-slate-500 mt-2">الحد الأقصى 4MB</p>
            </div>
        </div>

        {{-- المحتوى --}}
        <div>
            <div class="flex items-center justify-between mb-2">
                <label class="block text-sm text-slate-300">المحتوى</label>
                <span class="text-xs text-slate-400">الكلمات: <span id="wordCount">0</span></span>
            </div>
            <textarea id="editor" name="description">{{ old('description', $article->description) }}</textarea>
        </div>

        {{-- معرض الصور الحالي --}}
        @php
            $gallery = [];
            if (!empty($article->images)) {
                $decoded = is_string($article->images) ? json_decode($article->images, true) : $article->images;
                $gallery = is_array($decoded) ? $decoded : [];
            }
        @endphp

        @if(!empty($gallery))
        <div>
            <label class="block mb-2 text-sm text-slate-300">معرض الصور الحالي</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach($gallery as $index => $img)
                    <button type="button"
                        class="relative group border border-slate-700 rounded-lg overflow-hidden focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        onclick="openGallery({{ $index }})">
                        <img src="{{ asset('storage/'.$img) }}" class="h-28 w-full object-cover transition duration-200 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M15 3h6v6M21 3l-7 7"/>
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                            </svg>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
        @endif

        {{-- زر إضافة صور جديدة --}}
        <div>
            <label class="block mb-2 text-sm text-slate-300">إضافة صور جديدة للمعرض</label>
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
        </div>

        {{-- الأزرار --}}
        <div class="pt-2 flex items-center gap-3">
            <button type="button" id="previewBtn" class="px-6 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 font-semibold">
                معاينة
            </button>
            <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold shadow-lg shadow-indigo-500/20">
                تحديث المقال
            </button>
        </div>
    </form>
</div>

{{-- معاينة المقال --}}
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

{{-- Lightbox --}}
<div id="galleryModal" class="fixed inset-0 hidden items-center justify-center z-[9999]">
    <button type="button" class="close-btn text-white" onclick="closeGallery()">✕</button>
    <button type="button" class="nav-btn left-4 text-white" style="left:1rem" onclick="prevImage()">‹</button>
    <button type="button" class="nav-btn right-4 text-white" style="right:1rem" onclick="nextImage()">›</button>
    <img id="galleryImage" src="" class="max-h-[85vh] max-w-[92vw] rounded-lg shadow-2xl border border-slate-700">
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

        link: {
            addTargetToExternalLinks: false,
            decorators: { openInNewTab: false },
            defaultProtocol: 'https://'
        },
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
            document.getElementById('pvTitle').textContent = document.getElementById('titleInput').value || '—';
            document.getElementById('pvContent').innerHTML = ed.getData() || '<p class="text-slate-400">لا يوجد محتوى.</p>';
            document.getElementById('previewModal').classList.remove('hidden');
        });

        document.getElementById('closePreview').onclick = () => document.getElementById('previewModal').classList.add('hidden');
        document.getElementById('closePreview2').onclick = () => document.getElementById('previewModal').classList.add('hidden');
    });

    const ci = document.getElementById('coverInput'), ch = document.getElementById('coverFileHint');
    ci?.addEventListener('change', () => { ch.textContent = ci.files.length ? ci.files[0].name : ''; });

    const gi = document.getElementById('galleryInput'), gh = document.getElementById('galleryFilesHint');
    gi?.addEventListener('change', () => {
        if (gi.files.length === 0) { gh.textContent = ''; return; }
        gh.textContent = gi.files.length === 1 ? 'تم اختيار ملف واحد.' : `تم اختيار ${gi.files.length} ملفات.`;
    });
});

// 🖼️ Lightbox JS
let galleryImages = @json($gallery ?? []);
let currentIndex = 0;

function openGallery(i) {
    if (!galleryImages.length) return;
    currentIndex = i;
    updateGallery();
    const m = document.getElementById('galleryModal');
    m.classList.remove('hidden'); m.classList.add('flex');
}
function closeGallery() {
    const m = document.getElementById('galleryModal');
    m.classList.add('hidden'); m.classList.remove('flex');
}
function updateGallery() {
    document.getElementById('galleryImage').src = '/storage/' + galleryImages[currentIndex];
}
function nextImage() {
    currentIndex = (currentIndex + 1) % galleryImages.length;
    updateGallery();
}
function prevImage() {
    currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
    updateGallery();
}
document.addEventListener('keydown', e => {
    const hidden = document.getElementById('galleryModal').classList.contains('hidden');
    if (hidden) return;
    if (e.key === 'Escape') closeGallery();
    if (e.key === 'ArrowRight') nextImage();
    if (e.key === 'ArrowLeft') prevImage();
});
document.getElementById('galleryModal').addEventListener('click', e => {
    if (e.target.id === 'galleryModal') closeGallery();
});
</script>
@endpush
