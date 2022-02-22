<?php

namespace App\Http\Controllers;

use App\Models\Image;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function index()
    {
        $search = request()->input('for');
        $check = request()->has('page') || request()->has('for') || request()->has('sort_by');
        !$check ?: Cache::forget('images');

        $images = Cache::remember('images', $check ? 60 : 60 * 60 * 24 * 7, function () use ($search) {
            return Image::select(['name', 'path'])
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
        Artisan::call('optimize:clear');
        $response .= Artisan::output();
        Artisan::call('view:cache');
        $response .= '<br/>' . Artisan::output();

        return response(str_replace('!', '!<br/>', $response));
    }

    public function resize()
    {
        $url = url('storage/ENwV9Z1HV89sI48ect5k1645522125.jpg');
        $img = Image::cache(function ($image) use ($url) {
            $image->make($url)->resize(300, 200)->greyscale();
        }, 10, true);

        return $img;
    }
}
