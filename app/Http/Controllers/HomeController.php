<?php

namespace App\Http\Controllers;

use App\Models\Image;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function index()
    {
        $search = request()->input('for');
        $check = request()->has('page') || request()->has('for') || request()->has('sort_by');
        !$check ?: cache()->forget('images');

        $images = cache()->remember('images', $check ? 60 : 60 * 60 * 24 * 7, function () use ($search) {
            return Image::select(['id', 'name', 'path'])
                ->when($search, function ($query) use ($search) {
                    return $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('path', 'LIKE', "%{$search}%");
                })
                ->when(request()->input('sort_by') == 'latest', fn ($query) => $query->latest())
                ->when(request()->input('sort_by') == 'oldest', fn ($query) => $query->oldest())
                ->paginate(request()->input('paginate', 20))
                ->withQueryString()
                ->fragment('images');
        });
        return view('index', compact('images'));
    }

    public function optimize()
    {
        $response = '';
        Artisan::call('optimize');
        $response .= "Configuration cache cleared! Configuration cached successfully! Route cache cleared! Routes cached successfully! Files cached successfully!";
        Artisan::call('view:cache');
        $response .= '<br/>' . Artisan::output();

        return response(str_replace('!', '!<br/>', $response));
    }

    public function optimize_clear()
    {
        Artisan::call('optimize:clear');
        $response = "Compiled views cleared! Application cache cleared! Route cache cleared! Configuration cache cleared! Compiled services and packages files removed! Caches cleared successfully!";
        return response(str_replace('!', '!<br/>', $response));
    }
}
