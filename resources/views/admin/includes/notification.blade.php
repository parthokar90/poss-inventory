<div class="relative flex items-center">
    <a href="{{ route('item_stock_alert_notification') }}" class="p-2 text-slate-500 hover:text-blue-600 hover:bg-slate-100 rounded-full transition-all duration-200 relative group" title="Stock Alert Notifications">
        <i class="material-icons text-2xl group-hover:scale-105 transition-transform">notifications</i>

        @if($total_notification > 0)
        <span class="absolute top-1 right-1 flex h-4 w-4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-rose-500 text-xxs font-bold text-white flex items-center justify-center px-1">
                {{ $total_notification }}
            </span>
        </span>
        @endif
    </a>
</div>