@props(['title', 'items', 'route', 'color' => 'indigo', 'field' => 'title'])

<div class="rounded-2xl bg-slate-800/70 border border-slate-700 p-5 shadow-soft">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-sm font-semibold flex items-center gap-2 text-{{ $color }}-300">
            <i data-lucide="clock" class="w-4 h-4"></i> {{ $title }}
        </h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <tbody class="divide-y divide-slate-700">
                @forelse ($items as $item)
                    <tr class="hover:bg-slate-800/40">
                        <td class="px-3 py-2 text-slate-100 truncate max-w-[14rem]">
                            {{ Str::limit($item[$field] ?? '—', 40) }}
                        </td>
                        <td class="px-3 py-2 text-slate-400 text-xs whitespace-nowrap">
                            {{ $item->created_at->format('Y-m-d') }}
                        </td>
                        <td class="px-3 py-2 text-right">
                            <a href="{{ route($route, $item->id) }}" class="text-{{ $color }}-400 hover:text-{{ $color }}-300 text-xs">عرض</a>
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-3 py-3 text-slate-500 text-center" colspan="3">لا يوجد عناصر</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
