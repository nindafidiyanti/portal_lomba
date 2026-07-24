<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the user's notifications.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Get filter parameter
        $filter = $request->get('filter', 'all');

        // Base query
        $query = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc');

        // Apply filter
        if ($filter === 'unread') {
            $query->unread();
        } elseif ($filter === 'read') {
            $query->read();
        }

        // Paginate results
        $notifications = $query->paginate(20);

        // Get unread count for badge
        $unreadCount = Notification::where('user_id', $user->id)
            ->unread()
            ->count();

        return view('notification.index', compact('notifications', 'unreadCount', 'filter'));
    }

    /**
     * Mark a single notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->markAsRead();

        // If there's a URL, redirect there, otherwise back
        if ($notification->getUrl()) {
            return redirect($notification->getUrl());
        }

        return redirect()->back()->with('toast_success', 'Notifikasi telah dibaca');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->unread()
            ->update(['is_read' => true]);

        return redirect()->back()->with('toast_success', 'Semua notifikasi telah dibaca');
    }

    /**
     * Mark notifications as read via AJAX (for API/JS calls).
     */
    public function markRead(Request $request, $id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    /**
     * Delete a single notification.
     */
    public function destroy($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->delete();

        return redirect()->back()->with('toast_success', 'Notifikasi dihapus');
    }

    /**
     * Delete all read notifications.
     */
    public function deleteRead()
    {
        Notification::where('user_id', Auth::id())
            ->read()
            ->delete();

        return redirect()->back()->with('toast_success', 'Notifikasi yang sudah dibaca telah dihapus');
    }

    /**
     * Get unread notifications count (for AJAX/Polling).
     */
    public function getUnreadCount()
    {
        $count = Notification::where('user_id', Auth::id())
            ->unread()
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Get latest notifications (for dropdown/polling).
     */
    public function getLatest(Request $request)
    {
        $limit = $request->get('limit', 5);

        $notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

        return response()->json([
            'notifications' => $notifications->map(function($n) {
                return [
                    'id' => $n->id,
                    'title' => $n->title,
                    'message' => $n->message,
                    'type' => $n->type,
                    'icon' => $n->getIcon(),
                    'url' => $n->getUrl(),
                    'is_read' => $n->is_read,
                    'created_at' => $n->created_at->diffForHumans(),
                ];
            }),
            'unread_count' => Notification::where('user_id', Auth::id())->unread()->count(),
        ]);
    }

    /**
     * Clear all notifications for the user.
     */
    public function clearAll()
    {
        Notification::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('toast_success', 'Semua notifikasi telah dihapus');
    }

    /**
     * Static helper to create notifications from anywhere in the app.
     */
    public static function send(
        int $userId,
        string $title,
        string $message,
        string $type = 'info',
        ?string $url = null
    ) {
        return Notification::createNotification(
            $userId,
            $title,
            $message,
            $type,
            $url ? ['url' => $url] : null
        );
    }
}
