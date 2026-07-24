<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\ForumComment;
use Illuminate\Support\Facades\Auth;
use App\Models\TempatLatihan;
use App\Helpers\NotifHelper;

class ForumController extends Controller
{
    /** Daftar semua postingan */
    public function index(Request $request)
    {
        $query = Forum::with(['user', 'comments']);

        // Filter berdasarkan cabang olahraga
        if ($request->has('cabor') && $request->cabor != '' && $request->cabor != 'semua') {
            $query->where('cabor', $request->cabor);
        }

        $forums = $query->orderBy('is_pinned', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $forums = $query->latest()->paginate(10);

        $lombaJson = collect(); // kosong
        $tempatJson = TempatLatihan::all()->map(fn($t) => [
            'nama' => $t->nama_tempat,
            'cabang' => $t->cabor ?? '',
            'lokasi' => $t->alamat,
            'url' => route('tempatlatihan.show', $t->id)
        ]);

        return view('forum.index', compact('forums', 'lombaJson', 'tempatJson'));
    }

    /** Admin: Daftar semua postingan */
    public function adminIndex()
    {
        $forums = Forum::with(['user', 'comments'])->latest()->get();

        return view('admin.forum.dashboard', compact('forums'));
    }

    /** Admin: Form input forum */
    public function create()
    {
        return view('admin.forum.inputforum');
    }

    /** Admin: Simpan forum baru */
    public function adminStore(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'cabor' => 'nullable|string|max:50',
        ]);

        Forum::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'cabor' => $request->cabor,
        ]);

        return redirect()->route('admin.forum.index')
            ->with('toast_success', 'Forum berhasil dibuat!');
    }

    /** Simpan postingan baru */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'cabor' => 'nullable|string|max:50',
        ]);

        Forum::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'cabor' => $request->cabor,   // ← kolom baru (lihat catatan migrasi)
        ]);

        return redirect()->route('forum.index')
            ->with('toast_success', 'Postingan berhasil dibuat! Silakan lihat di forum.');
    }

    /** Detail postingan */
    public function show($id)
    {
        $forum = Forum::with(['user', 'comments.user', 'comments.replies.user'])->findOrFail($id);

        $lombaJson = collect();
        $tempatJson = TempatLatihan::all()->map(fn($t) => [
            'nama' => $t->nama_tempat,
            'cabang' => $t->cabor ?? '',
            'lokasi' => $t->alamat,
            'url' => route('tempatlatihan.show', $t->id)
        ]);

        return view('forum.show', compact('forum', 'lombaJson', 'tempatJson'));
    }

    /** Form edit */
    public function edit($id)
    {
        $forum = Forum::findOrFail($id);

        if ($forum->user_id != Auth::id())
            abort(403);

        $lombaJson = collect();
        $tempatJson = TempatLatihan::all()->map(fn($t) => [
            'nama' => $t->nama_tempat,
            'cabang' => $t->cabor ?? '',
            'lokasi' => $t->alamat,
            'url' => route('tempatlatihan.show', $t->id)
        ]);

        return view('forum.edit', compact('forum', 'lombaJson', 'tempatJson'));
    }

    /** Proses update */
    public function update(Request $request, $id)
    {
        $forum = Forum::findOrFail($id);

        if ($forum->user_id != Auth::id())
            abort(403);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'cabor' => 'nullable|string|max:50',
        ]);

        $forum->update([
            'title' => $request->title,
            'content' => $request->content,
            'cabor' => $request->cabor,
        ]);

        return redirect()->route('forum.show', $forum->id)
            ->with('toast_success', 'Postingan berhasil diperbarui!');
    }

    /** Hapus postingan */
    public function destroy($id)
    {
        $forum = Forum::findOrFail($id);

        if ($forum->user_id != Auth::id())
            abort(403);

        ForumComment::where('forum_id', $forum->id)->delete();
        $forum->delete();

        return redirect()->route('forum.index')
            ->with('toast_success', 'Postingan berhasil dihapus.');
    }

    /** Postingan saya */
    public function myPosts()
    {
        $forums = Forum::with('comments')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        $lombaJson = collect();
        $tempatJson = TempatLatihan::all()->map(fn($t) => [
            'nama' => $t->nama_tempat,
            'cabang' => $t->cabor ?? '',
            'lokasi' => $t->alamat,
            'url' => route('tempatlatihan.show', $t->id)
        ]);

        return view('forum.index', compact('forums', 'lombaJson', 'tempatJson'));
    }

    // ──────────────────────────────────────────────
    //  KOMENTAR
    // ──────────────────────────────────────────────

    /** Simpan komentar baru */
    public function storeComment(Request $request, $forumId)
    {
        $request->validate([
            'comment' => 'required|max:1000',
        ]);

        $forum = Forum::findOrFail($forumId);   // pastikan forum ada

        $comment = ForumComment::create([
            'forum_id' => $forumId,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id ?? null,
            'comment' => $request->comment,
        ]);

        // Kirim notifikasi ke pemilik forum jika komentar dari user lain
        if ($forum->user_id != Auth::id()) {
            NotifHelper::info(
                $forum->user_id,
                'Komentar baru di posting Anda',
                Auth::user()->name . ' mengomentari "' . \Str::limit($forum->title, 30) . '"',
                route('forum.show', $forum->id)
            );
        }

        // Kirim notifikasi balasan ke pemilik komentar yang dibalas
        if ($request->parent_id) {
            $parentComment = ForumComment::find($request->parent_id);
            if ($parentComment && $parentComment->user_id != Auth::id()) {
                NotifHelper::info(
                    $parentComment->user_id,
                    'Balasan baru di komentar Anda',
                    Auth::user()->name . ' membalas komentar Anda',
                    route('forum.show', $forum->id)
                );
            }
        }

        return redirect()->route('forum.show', $forumId)
            ->with('toast_success', $request->parent_id ? 'Balasan berhasil dikirim!' : 'Komentar berhasil ditambahkan!');
    }

    /** Hapus komentar */
    public function deleteComment($id)
    {
        $comment = ForumComment::findOrFail($id);

        // Izinkan jika pemilik komentar ATAU admin
        if ($comment->user_id != Auth::id() && !session('is_admin'))
            abort(403);

        $forumId = $comment->forum_id;
        $comment->delete();

        return redirect()->route('forum.show', $forumId)
            ->with('toast_success', 'Komentar berhasil dihapus.');
    }

    public function togglePin($id)
    {
        $forum = Forum::findOrFail($id);
        $forum->is_pinned = !$forum->is_pinned;
        $forum->save();

        $status = $forum->is_pinned ? 'dipin' : 'dilepas pin';
        return back()->with('toast_success', "Postingan berhasil {$status}!");
    }
}
