{{-- resources/views/forum/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Forum Diskusi — LombaKU')
@section('page_label', 'FORUM')

@push('styles')
    <style>
        .forum-hero {
            background: var(--black);
            padding: 20px 16px 22px;
            position: relative;
            overflow: hidden;
        }

        .forum-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 70% 80% at 80% 50%, rgba(41, 121, 255, .15) 0%, transparent 70%);
            pointer-events: none;
        }

        .forum-hero-eye {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(41, 121, 255, .15);
            border: 1px solid rgba(41, 121, 255, .3);
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 10px;
            font-weight: 700;
            color: var(--accent);
            letter-spacing: 1.2px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .forum-hero h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 1.5px;
            color: #fff;
            margin: 0 0 4px;
            line-height: 1.1;
        }

        .forum-hero h1 span {
            color: var(--accent);
        }

        .forum-hero p {
            color: #888;
            font-size: 12px;
            margin: 0 0 14px;
            line-height: 1.5;
        }

        .btn-tulis {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            line-height: 1;
        }

        .btn-tulis:hover {
            background: #1a5fd6;
            color: #fff;
        }

        /* Filter */
        .forum-filter {
            display: flex;
            gap: 6px;
            padding: 12px 16px 0;
            overflow-x: auto;
            flex-wrap: nowrap;
        }

        .forum-filter::-webkit-scrollbar {
            display: none;
        }

        .fpill {
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

        .fpill:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .fpill.active {
            background: var(--black);
            border-color: var(--black);
            color: #fff;
        }

        /* Post cards */
        .posts-list {
            padding: 12px 16px 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .post-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 1px 8px rgba(0, 0, 0, .06);
            transition: transform .18s, box-shadow .18s;
        }

        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .1);
        }

        .post-top {
            padding: 14px 14px 10px;
        }

        .post-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .ava {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--accent);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .post-author {
            font-size: 12px;
            font-weight: 700;
            color: var(--black);
        }

        .post-time {
            font-size: 10px;
            color: #aaa;
            margin-top: 1px;
        }

        .post-badge {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .8px;
            padding: 3px 8px;
            border-radius: 4px;
            text-transform: uppercase;
            white-space: nowrap; /* agar badge tidak terpotong */
        }

        .post-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--black);
            margin: 0 0 6px;
            line-height: 1.35;
            text-decoration: none;
            display: block;
        }

        .post-title:hover {
            color: var(--accent);
        }

        .post-excerpt {
            font-size: 12px;
            color: #666;
            line-height: 1.55;
            margin: 0;
        }

        .post-footer {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 8px 14px;
            border-top: 1px solid #f0f0f0;
        }

        .post-react {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            color: #888;
            cursor: pointer;
        }

        .post-react i {
            font-size: 14px;
        }

        .post-share {
            margin-left: auto;
            font-size: 11px;
            color: #ccc;
            cursor: pointer;
        }

        /* Form buat postingan */
        .create-form-wrap {
            background: #fff;
            border-radius: 14px;
            padding: 16px;
            margin: 12px 16px 0;
            box-shadow: 0 1px 8px rgba(0, 0, 0, .06);
            display: none;
        }

        .create-form-wrap.open {
            display: block;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 4px;
            color: #333;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 13px;
            font-family: inherit;
            outline: none;
            transition: border-color .2s;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--accent);
        }

        .form-actions {
            display: flex;
            gap: 8px;
        }

        .btn-submit {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
        }

        .btn-cancel {
            background: transparent;
            color: #666;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 13px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
        }

        /* Alert */
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 12px;
            margin: 12px 16px 0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 12px;
            margin: 12px 16px 0;
        }

        .alert-error ul {
            margin: 4px 0 0 16px;
        }

        /* Empty */
        .forum-empty {
            text-align: center;
            padding: 48px 20px;
            color: var(--text-muted);
        }

        .forum-empty i {
            font-size: 40px;
            opacity: .25;
            display: block;
            margin-bottom: 10px;
        }

        /* Pagination */
        .pagination-wrap {
            display: flex;
            justify-content: center;
            padding: 16px;
        }

        /* FAB tulis */
        .fab-wrap {
            position: sticky;
            bottom: 74px;
            z-index: 50;
            display: flex;
            justify-content: flex-end;
            padding: 0 16px;
            pointer-events: none;
        }

        .fab-write {
            pointer-events: all;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 12px 20px;
            font-size: 13px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 16px rgba(41, 121, 255, .35);
        }
    </style>
@endpush

@section('content')

    {{-- ── Hero ── --}}
    <div class="forum-hero">
        <h1>DISKUSI <span>OLAHRAGA</span></h1>
        <p>Bagikan pengalaman, tips, dan diskusi seputar olahraga.</p>
        @auth
            <button class="btn-tulis" onclick="toggleForm()">
                <i class="bi bi-pencil-fill"></i> Tulis Postingan
            </button>
        @else
            <a href="{{ route('login.user') }}" class="btn-tulis">
                <i class="bi bi-box-arrow-in-right"></i> Login untuk Posting
            </a>
        @endauth
    </div>

    {{-- ── Flash ── --}}
    @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    {{-- ── Form buat postingan ── --}}
    @auth
        <div class="create-form-wrap {{ $errors->any() ? 'open' : '' }}" id="createForm">
            <form action="{{ route('forum.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Judul Postingan</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Tulis judul yang menarik..."
                        required>
                </div>
                <div class="form-group">
                    <label>Cabang Olahraga</label>
                    <select name="cabor">
                        <option value="">-- Semua --</option>
                        @foreach($cabors as $cabor)
                            <option value="{{ strtolower($cabor) }}" {{ old('cabor') == strtolower($cabor) ? 'selected' : '' }}>
                                {{ $cabor }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Isi Postingan</label>
                    <textarea name="content" rows="4" placeholder="Ceritakan sesuatu yang berguna untuk komunitas..."
                        required>{{ old('content') }}</textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-submit">Kirim</button>
                    <button type="button" class="btn-cancel" onclick="toggleForm()">Batal</button>
                </div>
            </form>
        </div>
    @endauth

    {{-- ── Filter Pills ── --}}
    <div class="forum-filter">
        <a href="{{ route('forum.index') }}"
            class="fpill {{ !request('cabor') || request('cabor') == 'semua' ? 'active' : '' }}">Semua</a>
        @foreach($cabors as $cabor)
            <a href="{{ route('forum.index', ['cabor' => strtolower($cabor)]) }}"
                class="fpill {{ request('cabor') == strtolower($cabor) ? 'active' : '' }}">{{ $cabor }}</a>
        @endforeach
    </div>

    {{-- ── Empty State dengan Filter Info ── --}}
    @if($forums->isEmpty())
        <div class="forum-empty">
            <i class="bi bi-chat-square"></i>
            @if(request('cabor') && request('cabor') != 'semua')
                <p>Belum ada postingan {{ ucfirst(request('cabor')) }}. Jadilah yang pertama!</p>
            @else
                <p>Belum ada postingan. Jadilah yang pertama!</p>
            @endif
        </div>
    @else
        <div class="posts-list">
            @foreach($forums as $forum)
                @php
                    $colors = ['#2979ff', '#e8b800', '#22c55e', '#e53535', '#9333ea'];
                    $color = $colors[$forum->user_id % count($colors)];
                    $badgeColors = [
                        'karate' => ['bg' => '#e8f0ff', 'color' => '#2979ff'],
                        'badminton' => ['bg' => '#fff7e0', 'color' => '#b38900'],
                        'futsal' => ['bg' => '#e6f9ef', 'color' => '#15803d'],
                        'renang' => ['bg' => '#fce8e8', 'color' => '#b91c1c'],
                        'pencak silat' => ['bg' => '#f3e8ff', 'color' => '#7c3aed'],
                    ];
                    $badge = $badgeColors[$forum->cabor ?? ''] ?? ['bg' => '#f0f0f0', 'color' => '#555'];
                @endphp
                <div class="post-card">
                    <div class="post-top">
                        <div class="post-meta">
                            <div class="ava" style="background:{{ $color }}">
                                {{ strtoupper(substr($forum->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="post-author">{{ $forum->user->name }}</div>
                                <div class="post-time">{{ $forum->created_at->diffForHumans() }}</div>
                            </div>

                            {{-- Container untuk badge-badge --}}
                            <div class="post-badges"
                                style="display:flex; gap:6px; margin-left:auto; align-items:center; flex-wrap:wrap;">
                                @if(!empty($forum->cabor))
                                    <div class="post-badge" style="background:{{ $badge['bg'] }};color:{{ $badge['color'] }}">
                                        {{ ucfirst($forum->cabor) }}
                                    </div>
                                @endif

                                @if($forum->is_pinned)
                                    <div class="post-badge" style="background:#fef3c7;color:#92400e;">
                                        <i class="bi bi-pin-fill"></i> Pinned
                                    </div>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('forum.show', $forum->id) }}" class="post-title">{{ $forum->title }}</a>
                        <p class="post-excerpt">{{ Str::limit($forum->content, 120) }}</p>
                    </div>
                    <div class="post-footer">
                        <span class="post-react">
                            <i class="bi bi-heart"></i> {{ $forum->likes_count ?? 0 }}
                        </span>
                        <a href="{{ route('forum.show', $forum->id) }}" class="post-react" style="text-decoration:none;color:#888;">
                            <i class="bi bi-chat"></i> {{ $forum->comments->count() }}
                        </a>
                        @auth
                            @if($forum->user_id === Auth::id())
                                <a href="{{ route('forum.edit', $forum->id) }}" class="post-react"
                                    style="margin-left:auto;text-decoration:none;color:#aaa;">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('forum.destroy', $forum->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus postingan ini?')" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="post-react"
                                        style="background:none;border:none;cursor:pointer;color:#e53535;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @else
                                <span class="post-share" style="margin-left:auto;">
                                    <i class="bi bi-share"></i>
                                </span>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- ── Pagination ── --}}
    <div class="pagination-wrap">{{ $forums->withQueryString()->links() }}</div>

    {{-- FAB (floating action button) --}}
    @auth
        <div class="fab-wrap">
            <button class="fab-write" onclick="toggleForm(); window.scrollTo({top:0,behavior:'smooth'})">
                <i class="bi bi-pencil-fill"></i> Tulis
            </button>
        </div>
    @endauth

@endsection

@push('scripts')
    <script>
        function toggleForm() {
            document.getElementById('createForm').classList.toggle('open');
        }
    </script>
@endpush