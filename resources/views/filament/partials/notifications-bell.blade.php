@php
    use Illuminate\Support\Facades\Route;

    $u      = auth()->user();
    $items  = $u?->notifications()->latest()->take(10)->get() ?? collect();
    $unread = $u?->unreadNotifications()->count() ?? 0;
@endphp

<x-filament::dropdown placement="bottom-end" offset="8" teleport>
    {{-- =========== Trigger (bell + badge) =========== --}}
    <x-slot name="trigger">
        <button type="button" aria-label="Notifications" data-notif-trigger
            style="
                position:relative;
                display:inline-flex;align-items:center;justify-content:center;
                width:36px;height:36px;border-radius:9999px;transition:background .2s;
            "
            onmouseover="this.style.background='rgba(0,0,0,.06)';"
            onmouseout="this.style.background='transparent';">
            <x-filament::icon icon="heroicon-o-bell" class="h-5 w-5" />
            @if($unread > 0)
                <span style="
                    position:absolute;top:-3px;right:-3px;min-width:16px;height:16px;padding:0 4px;
                    display:inline-flex;align-items:center;justify-content:center;
                    border-radius:9999px;background:#2563eb;color:#fff;font-weight:700;font-size:10px;line-height:1;
                    box-shadow:0 0 0 2px #fff;
                ">
                    {{ $unread > 99 ? '99+' : $unread }}
                </span>
            @endif
        </button>
    </x-slot>

    {{-- =========== Panel =========== --}}
    <div role="menu" data-notif-panel
        style="
            width:18rem;max-width:min(18rem,calc(100vw - 16px));box-sizing:border-box;
            border-radius:12px;overflow:hidden;background:#fff;border:1px solid rgba(0,0,0,.06);
            box-shadow:0 14px 32px rgba(0,0,0,.16);transform:translateX(0);will-change:transform;
        ">

        {{-- Header --}}
        <div style="
            padding:8px 10px;background:linear-gradient(180deg,#2d6bf3 0%,#215ce9 100%);
            color:#fff;display:flex;align-items:center;justify-content:space-between;gap:6px;
        ">
            <div style="font-weight:700;font-size:13px;">Notifikasi</div>

            @if($unread > 0 && Route::has('notifications.markAllRead'))
                <form method="POST" action="{{ route('notifications.markAllRead') }}" style="margin:0">
                    @csrf
                    <button type="submit"
                        style="background:rgba(255,255,255,.16);border:none;color:#fff;
                               padding:2px 6px;border-radius:6px;font-size:10px;font-weight:600;cursor:pointer;white-space:nowrap;">
                        Tandai semua
                    </button>
                </form>
            @endif
        </div>

        {{-- List / Empty --}}
        @if ($items->isEmpty())
            <div style="padding:18px 12px;text-align:center;color:#6b7280;font-size:13px;">
                Belum ada notifikasi.
            </div>
        @else
            <ul style="max-height:320px;overflow:auto;margin:0;padding:0;list-style:none;">
                @foreach ($items as $n)
                    @php
                        $isUnread = is_null($n->read_at);
                        $title = data_get($n->data,'title','Notifikasi');
                        $body  = data_get($n->data,'body');
                        $url   = data_get($n->data,'url');
                    @endphp

                    <li
                        style="
                            padding:10px;border-bottom:1px solid rgba(0,0,0,.05);
                            background:{{ $isUnread ? 'rgba(37,99,235,.05)' : '#fff' }};
                            transition:background .12s;
                        "
                        onmouseover="this.style.background='{{ $isUnread ? 'rgba(37,99,235,.08)' : 'rgba(0,0,0,.03)' }}';"
                        onmouseout="this.style.background='{{ $isUnread ? 'rgba(37,99,235,.05)' : '#fff' }}';"
                    >
                        {{-- Grid: dot | content --}}
                        <div style="display:grid;grid-template-columns:14px 1fr;gap:10px;align-items:start;">
                            {{-- dot --}}
                            <span style="
                                margin-top:4px;width:8px;height:8px;border-radius:9999px;
                                background:{{ $isUnread ? '#2563eb' : '#d1d5db' }};
                                display:inline-block;
                            "></span>

                            {{-- content --}}
                            <div style="min-width:0">
                                {{-- title + time (1 line) --}}
                                <div style="display:flex;gap:8px;align-items:center;">
                                    <div style="
                                        font-weight:700;font-size:13px;
                                        white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
                                    ">
                                        {{ $title }}
                                    </div>
                                    <div style="margin-left:auto;color:#6b7280;font-size:11px;white-space:nowrap;">
                                        {{ $n->created_at?->diffForHumans() }}
                                    </div>
                                </div>

                                {{-- body (clamped) --}}
                                @if($body)
                                    <div style="
                                        margin-top:4px;color:#4b5563;font-size:12px;
                                        display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
                                    ">
                                        {{ $body }}
                                    </div>
                                @endif

                                {{-- actions (aligned baseline) --}}
                                <div style="margin-top:6px;display:flex;gap:16px;align-items:baseline;">
                                    @if($url)
                                        <a href="{{ $url }}"
                                           style="display:inline-block;font-size:12px;line-height:1.25;color:#2563eb;text-decoration:underline;">
                                            Buka
                                        </a>
                                    @endif

                                    @if($isUnread && Route::has('notifications.markRead'))
                                        <form method="POST" action="{{ route('notifications.markRead', $n->id) }}"
                                              style="margin:0;display:inline;">
                                            @csrf
                                            <button type="submit"
                                                style="all:unset;display:inline-block;font-size:12px;line-height:1.25;color:#2563eb;cursor:pointer;text-decoration:underline;">
                                                Tandai terbaca
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-filament::dropdown>

{{-- Auto-shift supaya panel tidak kepotong di kanan --}}
<script>
(function () {
    function adjustNotifPanel() {
        var panel = document.querySelector('[data-notif-panel]');
        if (!panel) return;
        panel.style.transform = 'translateX(0)';
        var r = panel.getBoundingClientRect();
        var pad = 8;
        var overflowRight = (r.right + pad) - window.innerWidth;
        if (overflowRight > 0) {
            panel.style.transform = 'translateX(' + (-overflowRight) + 'px)';
        }
    }
    var trig = document.querySelector('[data-notif-trigger]');
    if (trig) trig.addEventListener('click', function(){ setTimeout(adjustNotifPanel, 0); });
    window.addEventListener('resize', adjustNotifPanel);
})();
</script>
