{{-- ================================================
     COMMENT SECTION - Bubble/Card Style (mirip index.blade.php)
     ================================================ --}}

{{-- Style untuk comment section --}}
<style>
    /* ── COMMENT SECTION ── */
    .comment-section {
        margin-top: 16px;
        padding: 0 16px;
    }

    .comment-section-wrap {
        padding: 0 16px;
    }

    .comment-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e8e8e8;
    }

    .comment-header-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--accent);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 14px;
    }

    .comment-header h3 {
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: var(--black);
        margin: 0;
    }

    .comment-count {
        background: var(--accent);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 10px;
    }

    /* ── COMMENT FORM (Bubble Style) ── */
    .comment-form-wrap {
        background: #fff;
        border-radius: 14px;
        padding: 14px;
        margin-bottom: 14px;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
    }

    .comment-form-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
    }

    .comment-form-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--accent);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .comment-form-label {
        font-size: 12px;
        color: #888;
    }

    .comment-form-label strong {
        color: var(--black);
        font-weight: 700;
    }

    .comment-textarea {
        width: 100%;
        min-height: 80px;
        padding: 10px 12px;
        border: 1.5px solid #e0e0e0;
        border-radius: 10px;
        font-size: 13px;
        font-family: inherit;
        color: var(--black);
        resize: none;
        outline: none;
        transition: border-color .2s;
        line-height: 1.5;
        box-sizing: border-box;
    }

    .comment-textarea:focus {
        border-color: var(--accent);
    }

    .comment-textarea::placeholder {
        color: #aaa;
    }

    .comment-form-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
    }

    .comment-char-count {
        font-size: 11px;
        color: #aaa;
    }

    .btn-kirim-komentar {
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 12px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all .2s;
    }

    .btn-kirim-komentar:hover {
        background: #1a5fd6;
    }

    .btn-kirim-komentar:active {
        transform: scale(0.97);
    }

    /* Login prompt */
    .comment-login-prompt {
        background: #fff;
        border-radius: 14px;
        padding: 20px;
        text-align: center;
        margin-bottom: 14px;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
    }

    .comment-login-prompt p {
        font-size: 13px;
        color: #666;
        margin-bottom: 12px;
    }

    .comment-login-prompt a {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--accent);
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        transition: all .2s;
    }

    .comment-login-prompt a:hover {
        background: #1a5fd6;
    }

    /* ── COMMENT LIST (Bubble/Card Style) ── */
    .comment-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .comment-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
        transition: transform .18s, box-shadow .18s;
    }

    .comment-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 16px rgba(0,0,0,.1);
    }

    .comment-card-top {
        padding: 12px 14px 10px;
    }

    .comment-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
    }

    .comment-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--accent);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .comment-author-info {
        flex: 1;
        min-width: 0;
    }

    .comment-author-name {
        font-size: 12px;
        font-weight: 700;
        color: var(--black);
    }

    .comment-time {
        font-size: 10px;
        color: #aaa;
        margin-top: 1px;
    }

    .comment-badge {
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .8px;
        padding: 3px 8px;
        border-radius: 4px;
        text-transform: uppercase;
    }

    .comment-text {
        font-size: 13px;
        color: #444;
        line-height: 1.55;
        margin: 0;
        word-wrap: break-word;
    }

    .comment-footer {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 14px;
        border-top: 1px solid #f0f0f0;
    }

    .comment-action {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        color: #888;
        cursor: pointer;
        text-decoration: none;
        transition: color .15s;
    }

    .comment-action i {
        font-size: 14px;
    }

    .comment-action:hover {
        color: var(--accent);
    }

    .comment-action.delete:hover {
        color: #e53535;
    }

    .comment-action.delete {
        background: none;
        border: none;
        padding: 0;
        font-family: inherit;
    }

    /* Reply indicator */
    .reply-indicator {
        display: none;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: var(--accent);
        margin-bottom: 8px;
        padding: 8px 12px;
        background: #e8f0ff;
        border-radius: 8px;
    }

    .reply-indicator.show {
        display: flex;
    }

    .reply-indicator-text {
        flex: 1;
    }

    .btn-batal-balas {
        background: transparent;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 600;
        color: #888;
        cursor: pointer;
        transition: all .18s;
    }

    .btn-batal-balas:hover {
        border-color: #e53535;
        color: #e53535;
    }

    /* Nested replies inside card */
    .comment-replies {
        margin-top: 10px;
        padding-left: 16px;
        border-left: 2px solid #e8e8e8;
    }

    .reply-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 10px 12px;
        margin-top: 8px;
    }

    .reply-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
    }

    .reply-avatar {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--accent);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .reply-author {
        font-size: 11px;
        font-weight: 700;
        color: var(--black);
    }

    .reply-time {
        font-size: 10px;
        color: #aaa;
    }

    .reply-text {
        font-size: 12px;
        color: #444;
        line-height: 1.5;
        margin: 0;
    }

    .reply-footer {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 6px;
    }

    .reply-action {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 10px;
        color: #888;
        cursor: pointer;
        text-decoration: none;
        transition: color .15s;
        background: none;
        border: none;
        padding: 0;
        font-family: inherit;
    }

    .reply-action:hover {
        color: var(--accent);
    }

    .reply-action i {
        font-size: 12px;
    }

    /* Thread line for nested comments */
    .comment-nested {
        margin-left: 32px;
        padding-left: 14px;
        border-left: 2px solid #e8e8e8;
        position: relative;
    }

    .comment-nested::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e8e8e8;
    }

    .comment-nested:hover::before {
        background: var(--accent);
    }

    /* ── EMPTY STATE ── */
    .comment-empty {
        text-align: center;
        padding: 32px 20px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 1px 8px rgba(0,0,0,.06);
    }

    .comment-empty i {
        font-size: 36px;
        color: #ddd;
        display: block;
        margin-bottom: 10px;
    }

    .comment-empty p {
        font-size: 13px;
        color: #888;
        margin: 0;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 480px) {
        .comment-section {
            margin-top: 12px;
            padding: 0 12px;
        }

        .comment-section-wrap {
            padding: 0 12px;
        }

        .comment-card-top {
            padding: 10px 12px 8px;
        }

        .comment-footer {
            padding: 6px 12px;
            gap: 10px;
        }

        .comment-action {
            font-size: 10px;
        }

        .comment-action i {
            font-size: 13px;
        }

        .comment-nested {
            margin-left: 24px;
            padding-left: 10px;
        }

        .comment-form-wrap {
            padding: 12px;
        }

        .comment-textarea {
            font-size: 13px;
            min-height: 70px;
        }

        .btn-kirim-komentar {
            padding: 7px 14px;
            font-size: 12px;
        }
    }

    @media (min-width: 769px) {
        .comment-section {
            margin-top: 20px;
            padding: 0 20px;
        }

        .comment-section-wrap {
            padding: 0 20px;
        }

        .comment-header {
            margin-bottom: 16px;
            padding-bottom: 14px;
        }

        .comment-form-wrap {
            margin-bottom: 16px;
        }

        .comment-list {
            gap: 12px;
        }

        .comment-card {
            border-radius: 16px;
        }
    }
</style>

{{-- Comment Section Bubble/Card Style --}}
<div class="comment-section">

    {{-- Header --}}
    <div class="comment-section-wrap">
        <div class="comment-header">
            <div class="comment-header-icon">
                <i class="bi bi-chat-dots-fill"></i>
            </div>
            <h3>KOMENTAR</h3>
            <span class="comment-count">{{ $forum->comments->count() }}</span>
        </div>
    </div>

    {{-- Form Komentar Bubble Style --}}
    <div class="comment-section-wrap">
        @auth
            <div class="comment-form-wrap">
                <div class="comment-form-header">
                    <div class="comment-form-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="comment-form-label">
                        Komentar sebagai <strong>{{ Auth::user()->name }}</strong>
                    </span>
                </div>

                <form action="{{ route('forum.comment.store', $forum->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent_id" id="reply-parent-id" value="">
                    <div class="reply-indicator" id="reply-indicator">
                        <i class="bi bi-arrow-return-right"></i>
                        <span class="reply-indicator-text" id="reply-indicator-text">Membalas @<span id="reply-to-username"></span></span>
                        <button type="button" id="btn-batal-balas" class="btn-batal-balas" onclick="batalBalas()">
                            Batal
                        </button>
                    </div>
                    <textarea
                        id="comment-textarea"
                        name="comment"
                        class="comment-textarea"
                        placeholder="Tulis komentar Anda..."
                        maxlength="1000"
                        required
                    >{{ old('comment') }}</textarea>

                    <div class="comment-form-actions">
                        <span class="comment-char-count">0/1000 karakter</span>
                        <button type="submit" class="btn-kirim-komentar">
                            <i class="bi bi-send-fill"></i>
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="comment-login-prompt">
                <p>Login untuk meninggalkan komentar</p>
                <a href="{{ route('login.user') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login untuk Komentar
                </a>
            </div>
        @endauth
    </div>

    {{-- Daftar Komentar Bubble/Card Style --}}
    <div class="comment-section-wrap">
        @if($forum->comments->isEmpty())
            <div class="comment-empty">
                <i class="bi bi-chat-square"></i>
                <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
            </div>
        @else
            <div class="comment-list">
                @foreach($forum->comments as $comment)
                    @php
                        $colors = ['#2979ff','#e8b800','#22c55e','#e53535','#9333ea','#06b6d4','#ec4899'];
                        $color = $colors[$loop->index % count($colors)];
                        $isAdmin = session('is_admin') && $comment->user_id === Auth::id();
                    @endphp

                    <div class="comment-card">
                        <div class="comment-card-top">
                            <div class="comment-meta">
                                <div class="comment-avatar" style="background: {{ $color }}">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                                <div class="comment-author-info">
                                    <div class="comment-author-name">{{ $comment->user->name }}</div>
                                    <div class="comment-time">{{ $comment->created_at->diffForHumans() }}</div>
                                </div>
                                @if($isAdmin)
                                    <span class="comment-badge" style="background:#e8f0ff;color:#2979ff;">
                                        Admin
                                    </span>
                                @endif
                            </div>
                            <p class="comment-text">{{ $comment->comment }}</p>
                        </div>

                        <div class="comment-footer">
                            <button type="button" class="comment-action reply-btn"
                                    data-username="{{ $comment->user->name }}"
                                    data-comment-id="{{ $comment->id }}"
                                    onclick="replyTo(this)">
                                <i class="bi bi-chat"></i>
                                Balas
                            </button>

                            {{-- Delete untuk pemilik komentar atau admin --}}
                            @auth
                                @if($comment->user_id === Auth::id() || session('is_admin'))
                                    <form action="{{ route('forum.comment.delete', $comment->id) }}" method="POST"
                                          style="display:contents;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="comment-action delete"
                                                onclick="return confirm('Hapus komentar ini?')">
                                            <i class="bi bi-trash"></i>
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>

                        {{-- BALASAN (NESTED REPLIES) --}}
                        @if($comment->replies && $comment->replies->count() > 0)
                            <div class="comment-replies">
                                @foreach($comment->replies as $reply)
                                    @php
                                        $replyColor = $colors[($loop->parent->index + 1) % count($colors)];
                                    @endphp
                                    <div class="reply-card">
                                        <div class="reply-meta">
                                            <div class="reply-avatar" style="background: {{ $replyColor }}">
                                                {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                            </div>
                                            <span class="reply-author">{{ $reply->user->name }}</span>
                                            <span class="reply-time">{{ $reply->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="reply-text">{{ $reply->comment }}</p>
                                        <div class="reply-footer">
                                            @auth
                                                <button type="button" class="reply-action"
                                                        data-username="{{ $reply->user->name }}"
                                                        data-comment-id="{{ $comment->id }}"
                                                        onclick="replyTo(this)">
                                                    <i class="bi bi-chat"></i>
                                                    Balas
                                                </button>
                                                @if($reply->user_id === Auth::id() || session('is_admin'))
                                                    <form action="{{ route('forum.comment.delete', $reply->id) }}" method="POST"
                                                          style="display:contents;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="reply-action" style="color:#e53535;"
                                                                onclick="return confirm('Hapus balasan ini?')">
                                                            <i class="bi bi-trash"></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

{{-- Script untuk character count & reply --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('comment-textarea');
        if (textarea) {
            textarea.addEventListener('input', function() {
                const count = this.value.length;
                const counter = this.parentElement.querySelector('.comment-char-count');
                if (counter) {
                    counter.textContent = count + '/1000 karakter';
                }
            });

            // Auto-resize
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 200) + 'px';
            });
        }
    });

    // Fungsi reply - scroll ke form dan isi dengan @username
    function replyTo(btn) {
        const username = btn.getAttribute('data-username');
        const commentId = btn.getAttribute('data-comment-id');
        const textarea = document.getElementById('comment-textarea');
        const parentIdInput = document.getElementById('reply-parent-id');
        const replyIndicator = document.getElementById('reply-indicator');
        const replyToUsername = document.getElementById('reply-to-username');

        if (textarea && parentIdInput) {
            // Set parent_id untuk balasan
            parentIdInput.value = commentId;

            // Tampilkan indicator
            if (replyIndicator) {
                replyIndicator.classList.add('show');
            }
            if (replyToUsername) {
                replyToUsername.textContent = username;
            }

            // Scroll ke form komentar
            textarea.scrollIntoView({ behavior: 'smooth', block: 'center' });

            // Isi textarea dengan @username
            textarea.value = '@' + username + ' ';
            textarea.focus();

            // Update character count
            const counter = textarea.parentElement.querySelector('.comment-char-count');
            if (counter) {
                counter.textContent = textarea.value.length + '/1000 karakter';
            }

            // Trigger auto-resize
            textarea.style.height = 'auto';
            textarea.style.height = Math.min(textarea.scrollHeight, 200) + 'px';
        }
    }

    // Fungsi batal balas
    function batalBalas() {
        const parentIdInput = document.getElementById('reply-parent-id');
        const replyIndicator = document.getElementById('reply-indicator');
        const textarea = document.getElementById('comment-textarea');

        if (parentIdInput) {
            parentIdInput.value = '';
        }
        if (replyIndicator) {
            replyIndicator.classList.remove('show');
        }
        if (textarea) {
            textarea.value = '';
            const counter = textarea.parentElement.querySelector('.comment-char-count');
            if (counter) {
                counter.textContent = '0/1000 karakter';
            }
            textarea.style.height = 'auto';
            textarea.style.height = '80px';
        }
    }
</script>
