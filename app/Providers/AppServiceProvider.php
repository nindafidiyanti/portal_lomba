<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Http\ViewComposers\SettingsComposer;
use App\Http\ViewComposers\CaborComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share notification count to all views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $unreadCount = Auth::user()->getUnreadNotificationsCount();
                View::share('unreadNotificationCount', $unreadCount);
            } else {
                View::share('unreadNotificationCount', 0);
            }
        });

        // Share settings data to admin forms
        View::composer(['admin.inputlomba', 'admin.editlomba', 'admin.tempatlatihan.inputlatihan', 'admin.tempatlatihan.editlatihan'], SettingsComposer::class);

        // Share cabang olahraga data to public views (landing & forum)
        View::composer(['landing', 'forum.index'], CaborComposer::class);

        // ===== TAMBAHAN: Search data untuk layout app =====
        View::composer('layouts.app', function ($view) {
            $searchData = $this->getSearchData();
            $view->with('searchData', $searchData);
        });
    }

    // Tambahkan method helper di dalam class ini
    private function getSearchData()
    {
        $data = [];

        // Lomba
        $lombas = \App\Models\Lomba::select('id', 'judul as nama', 'cabor', 'lokasi')->get();
        foreach ($lombas as $item) {
            $data[] = [
                'type' => 'lomba',
                'nama' => $item->nama,
                'cabang' => $item->cabor ?? '',
                'lokasi' => $item->lokasi,
                'url' => route('lomba.detail', $item->id),
            ];
        }

        // Tempat Latihan
        $tempat = \App\Models\TempatLatihan::select('id', 'nama_tempat as nama', 'cabor', 'alamat as lokasi')->get();
        foreach ($tempat as $item) {
            $data[] = [
                'type' => 'tempat',
                'nama' => $item->nama,
                'cabang' => $item->cabor ?? '',
                'lokasi' => $item->lokasi,
                'url' => route('tempatlatihan.show', $item->id),
            ];
        }

        // Forum
        $forums = \App\Models\Forum::select('id', 'title as nama', 'cabor')->get();
        foreach ($forums as $item) {
            $data[] = [
                'type' => 'forum',
                'nama' => $item->nama,
                'cabang' => $item->cabor ?? '',
                'lokasi' => 'Forum Diskusi',
                'url' => route('forum.show', $item->id),
            ];
        }

        return $data;
    }
}
