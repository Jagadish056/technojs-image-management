<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ImageController extends Controller
{
    use ImageUpload;

    public function index()
    {
        $images = Image::with(['user:id,name'])
            ->select(['id', 'user_id', 'name', 'size', 'path', 'created_at'])
            ->when(!Gate::check('is-admin'), fn ($query) => $query->where('user_id', auth()->id()))
            ->when(request()->input('sort_by') == 'latest', fn ($query) => $query->latest())
            ->when(request()->input('sort_by') == 'oldest', fn ($query) => $query->oldest())
            ->paginate(request()->input('paginate', 20))
            ->withQueryString()
            ->fragment('images');
        return view('user.image.index', compact('images'));
    }

    public function create()
    {
        return view('user.image.create');
    }


    public function store(Request $request)
    {
        $files = $request->file('image');

        if (!is_array($files)) {
            return back()->with(feedback('No image found.', 'error'));
        }

        foreach ($files as $file) {

            if (!$this->checkImage($file)) {
                return back()->with(feedback('Invalid image format / size.', 'error'));
            }

            auth()->user()->images()->create($this->storeImage($file));
        }

        return to_route('image.index')->with(feedback(count($files) . ' File(s) uploaded successfully.', 'success'));
    }


    public function destroy(Image $image)
    {
        $this->authorize('delete', $image);

        $path = str($image->path)->replaceFirst('storage', 'public');

        if (!$this->deleteImage($path) && request()->input('email') != auth()->user()->email) {

            return back()->with(feedback('File not found.', 'error'));
        }

        $image->delete();

        return back()->with(feedback('Image successfully deleted.', 'success'));
    }
}
