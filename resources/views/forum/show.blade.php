@extends('layouts.app')

@section('title', 'Diskusi - LombaKU')
@section('page_label', 'FORUM')

@push('styles')
<style>
    /* ── DETAIL POST - Bubble/Card Style (Sama dengan index.blade.php) ── */
    .detail-wrap {
        padding: 0 16px;
    }

    .detail-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
        margin-bottom: 10px;
        transition: transform .18s, box-shadow .18s;
    }

    .detail-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,.1);
    }

    .detail-card-top {
        padding: 14px 14px 12px;
    }

    /* Back button */
    .detail-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #888;
        text-decoration: none;
        font-size: 12px;
        margin-bottom: 10px;
        transition: color .15s;
    }

    .detail-back:hover {
        color: var(--accent);
    }

    /* Meta info */
    .detail-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .detail-ava {
        width: 36px;
        height: 36px;
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

    .detail-author-info {
        flex: 1;
        min-width: 0;
    }

    .detail-author-name {
        font-size: 12px;
        font-weight: 700;
        color: var(--black);
    }

    .detail-time {
        font-size: 10px;
        color: #aaa;
        margin-top: 1px;
    }

    .detail-badge {
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .8px;
        padding: 3px 8px;
        border-radius: 4px;
        text-transform: uppercase;
        margin-left: auto;
    }

    /* Title */
    .detail-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--black);
        line-height: 1.35;
        margin: 0 0 12px;
    }

    /* Content - inside card */
    .detail-text {
        font-size: 14px;
        line-height: 1.7;
        color: #444;
        padding: 0 14px 14px;
    }

    /* Footer */
    .detail-footer {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 10px 14px;
        border-top: 1px solid #f0f0f0;
    }

    .detail-action {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        color: #888;
        cursor: pointer;
        text-decoration: none;
        transition: color .15s;
        background: none;
        border: none;
        padding: 0;
        font-family: inherit;
    }

    .detail-action:hover {
        color: var(--accent);
    }

    .detail-action i {
        font-size: 14px;
    }

    .detail-action.delete:hover {
        color: #e53535;
    }

    .detail-action.edit:hover {
        color: var(--accent);
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 480px) {
        .detail-wrap {
            padding: 0 12px;
        }

        .detail-card {
            border-radius: 12px;
        }

        .detail-card-top {
            padding: 12px 12px 10px;
        }

        .detail-ava {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }

        .detail-title {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .detail-text {
            padding: 0 12px 12px;
            font-size: 13px;
        }

        .detail-footer {
            padding: 8px 12px;
            gap: 10px;
        }

        .detail-action {
            font-size: 10px;
        }

        .detail-action i {
            font-size: 13px;
        }
    }

    @media (min-width: 769px) {
        .detail-wrap {
            padding: 0 20px;
        }

        .detail-card {
            border-radius: 16px;
        }

        .detail-card-top {
            padding: 18px 18px 14px;
        }

        .detail-title {
            font-size: 16px;
            margin-bottom: 14px;
        }

        .detail-text {
            padding: 0 18px 18px;
            font-size: 14px;
        }

        .detail-footer {
            padding: 12px 18px;
        }
    }
</style>
@endpush

@section('content')

{{-- ── Back Button ── --}}
<div class="detail-wrap">
    <a href="{{ route('forum.index') }}" class="detail-back">
        <i class="bi bi-arrow-left"></i>
        Kembali ke Forum
    </a>
</div>

{{-- ── Detail Card (Gabungan) ── --}}
@php
    $colors = ['#2979ff','#e8b800','#22c55e','#e53535','#9333ea'];
    $color = $colors[$forum->user_id % count($colors)];
    $badgeColors = [
        'karate'       => ['bg'=>'#e8f0ff','color'=>'#2979ff'],
        'badminton'    => ['bg'=>'#fff7e0','color'=>'#b38900'],
        'futsal'       => ['bg'=>'#e6f9ef','color'=>'#15803d'],
        'renang'       => ['bg'=>'#fce8e8','color'=>'#b91c1c'],
        'pencak silat' => ['bg'=>'#f3e8ff','color'=>'#7c3aed'],
    ];
    $badge = $badgeColors[$forum->cabor ?? ''] ?? ['bg'=>'#f0f0f0','color'=>'#555'];
@endphp

<div class="detail-wrap">
    <div class="detail-card">
        <div class="detail-card-top">
            <div class="detail-meta">
                <div class="detail-ava" style="background:{{ $color }}">
                    {{ strtoupper(substr($forum->user->name, 0, 1)) }}
                </div>
                <div class="detail-author-info">
                    <div class="detail-author-name">{{ $forum->user->name }}</div>
                    <div class="detail-time">{{ $forum->created_at->diffForHumans() }}</div>
                </div>
                @if(!empty($forum->cabor))
                    <div class="detail-badge" style="background:{{ $badge['bg'] }};color:{{ $badge['color'] }}">
                        {{ ucfirst($forum->cabor) }}
                    </div>
                @endif
            </div>

            <h1 class="detail-title">{{ $forum->title }}</h1>
        </div>

        <div class="detail-text">
            {!! nl2br(e($forum->content)) !!}
        </div>

        <div class="detail-footer">
            <span class="detail-action">
                <i class="bi bi-chat"></i>
                {{ $forum->comments->count() }} Komentar
            </span>

            @auth
                @if($forum->user_id === Auth::id())
                    <form action="{{ route('forum.destroy', $forum->id) }}" method="POST"
                          style="display:inline;" onsubmit="return confirm('Hapus postingan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="detail-action delete">
                            <i class="bi bi-trash"></i>
                            Hapus
                        </button>
                    </form>
                @endif
            @endauth
        </div>
    </div>
</div>

{{-- ── Comment Section (Include dari file terpisah) ── --}}
@include('forum.comment')

@endsection
