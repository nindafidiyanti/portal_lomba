@extends('layouts.app')

@section('title', 'Notifikasi')
@section('page_label', 'NOTIFIKASI')

@push('styles')
    <style>
        /* Header Section */
        .notif-header {
            background: var(--black);
            padding: 20px 16px 22px;
            position: relative;
            overflow: hidden;
        }

        .notif-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 70% 80% at 80% 50%, rgba(41, 121, 255, .15) 0%, transparent 70%);
            pointer-events: none;
        }

        .notif-header h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 1.5px;
            color: #fff;
            margin: 0 0 4px;
            line-height: 1.1;
        }

        .notif-header h1 span {
            color: var(--accent);
        }

        .notif-header p {
            color: #888;
            font-size: 12px;
            margin: 0 0 14px;
            line-height: 1.5;
        }

        .btn-header-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-action-sm {
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            border: none;
            font-family: inherit;
            line-height: 1;
        }

        .btn-read-all {
            background: var(--accent);
            color: #fff;
        }

        .btn-read-all:hover {
            background: #1a5fd6;
            color: #fff;
        }

        .btn-delete-read {
            background: rgba(255, 255, 255, .1);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, .2);
        }

        .btn-delete-read:hover {
            background: rgba(255, 255, 255, .2);
            color: #fff;
        }



        /* Filter Tabs */
        .notif-filter {
            display: flex;
            gap: 6px;
            padding: 12px 16px 0;
            overflow-x: auto;
            flex-wrap: nowrap;
        }

        .notif-filter::-webkit-scrollbar {
            display: none;
        }

        .notif-pill {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            border: 1.5px solid #ddd;
            background: #fff;
            color: #555;
            white-space: nowrap;
            transition: all .15s;
            flex-shrink: 0;
            text-decoration: none;
        }

        .notif-pill:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .notif-pill.active {
            background: var(--black);
            border-color: var(--black);
            color: #fff;
        }

        .notif-pill .count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            background: rgba(0, 0, 0, .1);
            border-radius: 10px;
            font-size: 10px;
            margin-left: 5px;
        }

        .notif-pill.active .count {
            background: rgba(255, 255, 255, .2);
        }

        /* Notification List */
        .notif-list {
            padding: 12px 16px 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .notif-card {
            background: #fff;
            border-radius: 14px;
            padding: 14px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            box-shadow: 0 1px 8px rgba(0, 0, 0, .06);
            transition: transform .18s, box-shadow .18s;
            text-decoration: none;
            color: inherit;
            border-left: 4px solid transparent;
        }

        .notif-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .1);
        }

        .notif-card.unread {
            border-left-color: var(--accent);
            background: linear-gradient(135deg, rgba(41, 121, 255, 0.03), #fff);
        }

        /* Icon */
        .notif-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notif-icon i {
            font-size: 18px;
            color: white;
        }

        .notif-icon.type-info {
            background: linear-gradient(135deg, var(--accent), #1a6ce8);
        }

        .notif-icon.type-success {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .notif-icon.type-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .notif-icon.type-error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        /* Content */
        .notif-content {
            flex: 1;
            min-width: 0;
            text-decoration: none;
            color: inherit;
            display: block;
            cursor: pointer;
        }

        .notif-content:hover .notif-title {
            color: var(--accent);
        }

        .notif-title {
            font-weight: 700;
            font-size: 13px;
            color: var(--black);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .notif-title .new-badge {
            background: var(--accent);
            color: white;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            letter-spacing: 0.5px;
        }

        .notif-message {
            font-size: 12px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 8px;
        }

        .notif-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 10px;
            color: #aaa;
        }

        .notif-time {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Actions */
        .notif-actions {
            display: flex;
            flex-direction: column;
            gap: 6px;
            opacity: 0;
            transition: opacity .18s;
        }

        .notif-card:hover .notif-actions {
            opacity: 1;
        }

        .btn-sm-icon {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .15s;
            font-size: 14px;
        }

        .btn-sm-read {
            background: rgba(34, 197, 94, .1);
            color: #22c55e;
        }

        .btn-sm-read:hover {
            background: #22c55e;
            color: white;
        }

        .btn-sm-delete {
            background: rgba(239, 68, 68, .1);
            color: #ef4444;
        }

        .btn-sm-delete:hover {
            background: #ef4444;
            color: white;
        }

        /* Empty State */
        .notif-empty {
            text-align: center;
            padding: 48px 20px;
            color: var(--text-muted);
        }

        .notif-empty i {
            font-size: 48px;
            opacity: .25;
            display: block;
            margin-bottom: 12px;
        }

        .notif-empty p {
            font-size: 13px;
            color: #888;
        }

        /* Pagination */
        .pagination-wrap {
            display: flex;
            justify-content: center;
            padding: 16px;
        }

        /* Mobile adjustments */
        @media (max-width: 480px) {
            .notif-actions {
                opacity: 1;
                flex-direction: row;
            }

            .btn-header-group {
                gap: 6px;
            }

            .btn-action-sm {
                padding: 9px 18px;
                font-size: 13px;
                line-height: 1; /* ← tambahkan ini */

            }
        }
    </style>
@endpush

@section('content')

    <div class="notif-header">
        <h1>NOTIFIKASI <span>KAMU</span></h1>
        <p>Kelola semua notifikasi Anda di sini.</p>
        <div class="btn-header-group">
            <a href="#" class="btn-action-sm btn-read-all"
                onclick="event.preventDefault(); document.getElementById('markAllReadForm').submit();">
                <i class="bi bi-check-all"></i> Tandai Dibaca
            </a>
            <form id="markAllReadForm" action="{{ route('notifications.markAllRead') }}" method="POST"
                style="display:none;">
                @csrf
            </form>

            <a href="#" class="btn-action-sm btn-delete-read"
                onclick="event.preventDefault(); if(confirm('Hapus semua notifikasi yang sudah dibaca?')) { document.getElementById('deleteReadForm').submit(); }">
                <i class="bi bi-trash"></i> Hapus Dibaca
            </a>
            <form id="deleteReadForm" action="{{ route('notifications.deleteRead') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>
    </div>

    {{-- ── Filter Tabs ── --}}
    <div class="notif-filter">
        <a href="{{ route('notifications.index', ['filter' => 'all']) }}"
            class="notif-pill {{ $filter === 'all' ? 'active' : '' }}">
            Semua <span class="count">{{ $notifications->total() }}</span>
        </a>
        <a href="{{ route('notifications.index', ['filter' => 'unread']) }}"
            class="notif-pill {{ $filter === 'unread' ? 'active' : '' }}">
            Belum Dibaca <span class="count">{{ $unreadCount }}</span>
        </a>
        <a href="{{ route('notifications.index', ['filter' => 'read']) }}"
            class="notif-pill {{ $filter === 'read' ? 'active' : '' }}">
            Dibaca
        </a>
    </div>

    {{-- ── Notification List ── --}}
    @if($notifications->count() > 0)
        <div class="notif-list">
            @foreach($notifications as $notification)
                <div class="notif-card {{ $notification->is_unread ? 'unread' : '' }}" id="notif-{{ $notification->id }}">
                    <div class="notif-icon type-{{ $notification->type }}">
                        <i class="bi {{ $notification->getIcon() }}"></i>
                    </div>

                    <a href="{{ $notification->getUrl() ?? '#' }}" class="notif-content" onclick="markAsReadWithRedirect({{ $notification->id }}, '{{ $notification->getUrl() ?? '' }}')">
                        <div class="notif-title">
                            {{ $notification->title }}
                            @if($notification->is_unread)
                                <span class="new-badge">BARU</span>
                            @endif
                        </div>
                        <div class="notif-message">{{ $notification->message }}</div>
                        <div class="notif-meta">
                            <span class="notif-time">
                                <i class="bi bi-clock"></i>
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </a>

                    <div class="notif-actions">
                        @if($notification->is_unread)
                            <a href="{{ route('notifications.markRead', $notification->id) }}" class="btn-sm-icon btn-sm-read"
                                title="Tandai Dibaca" onclick="event.preventDefault(); event.stopPropagation(); markAsRead({{ $notification->id }});">
                                <i class="bi bi-check"></i>
                            </a>
                        @endif

                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm-icon btn-sm-delete" title="Hapus"
                                onclick="event.stopPropagation(); return confirm('Hapus notifikasi ini?');">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($notifications->hasPages())
            <div class="pagination-wrap">
                {{ $notifications->withQueryString()->links() }}
            </div>
        @endif
    @else
        {{-- Empty State --}}
        <div class="notif-empty">
            <i class="bi bi-bell-slash"></i>
            <p>Tidak ada notifikasi untuk saat ini.</p>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        // Mark notification as read via AJAX
        function markAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const item = document.getElementById(`notif-${notificationId}`);
                        if (item) {
                            item.classList.remove('unread');
                            const badge = item.querySelector('.new-badge');
                            if (badge) badge.remove();
                            const readBtn = item.querySelector('.btn-sm-read');
                            if (readBtn) readBtn.remove();
                            updateUnreadCount();
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Mark as read and redirect to the URL
        function markAsReadWithRedirect(notificationId, url) {
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateUnreadCount();
                    }
                    // Redirect to forum show page
                    if (url) {
                        window.location.href = url;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Still redirect even if fetch fails
                    if (url) {
                        window.location.href = url;
                    }
                });
        }

        // Update unread count
        function updateUnreadCount() {
            fetch('{{ route('notifications.unreadCount') }}')
                .then(response => response.json())
                .then(data => {
                    const unreadPill = document.querySelector('.notif-pill:nth-child(2) .count');
                    if (unreadPill) {
                        unreadPill.textContent = data.count;
                    }
                    const navBadge = document.getElementById('navNotifBadge');
                    if (navBadge) {
                        if (data.count > 0) {
                            navBadge.style.display = 'block';
                            navBadge.textContent = data.count > 9 ? '9+' : data.count;
                        } else {
                            navBadge.style.display = 'none';
                        }
                    }
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateUnreadCount();
        });
    </script>
@endpush