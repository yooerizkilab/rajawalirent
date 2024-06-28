<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CmsController extends Controller
{
    // About
    public function cmsAbout()
    {
        return view('backend.cms.about.index');
    }

    // Blog
    public function cmsBlog()
    {
        $blog = Blog::orderBy('created_at', 'DESC')->when(request()->q, function ($blog) {
            $blog->where('title', 'like', '%' . request()->q . '%')
                ->orWhere('published_at', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('backend.cms.blog.index', compact('blog'));
    }

    public function cmsCreateBlog()
    {
        return view('backend.cms.blog.create');
    }

    public function cmsStoreBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'published_at' => 'nullable|date',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg',
            'tag' => 'required|array',
            'category' => 'nullable|string|max:100',
        ]);

        // Wrap the database operations in a transaction
        DB::beginTransaction();

        try {

            $tag = implode(',', $request->tag);

            $publish = $request->published_at; // Corrected spelling
            $timestamp = $publish ? Carbon::parse($publish) : null;

            $filename = '';
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = $file->getClientOriginalName();
                $file->storeAs('public/thumbnail', $filename);
            }

            $data = [
                'title' => $request->title,
                'content' => $request->content,
                'author' => $request->author,
                'published_at' => $timestamp,
                'thumbnail' => $filename,
                'slug' => Str::slug($request->title),
                'tag' => $tag,
                'category' => $request->category,
            ];

            // dd($data);

            Blog::create($data);

            DB::commit();

            return redirect()->back()->with(['success' => 'Blog created successfully !!']);
        } catch (\Exception $e) {
            DB::rollBack();
            // Handle the exception appropriately
            return redirect()->back()->with(['error' => 'Failed to create blog. Please try again later.']);
        }
    }

    public function cmsEditBlog($id)
    {
        $blog = Blog::findOrFail($id);

        return view('backend.cms.blog.edit', compact('blog'));
    }

    public function cmsUpdateBlog(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'published_at' => 'nullable|date',
            'thumbnail' => 'sometimes|nullable|image|mimes:png,jpg,jpeg',
            'tag' => 'required|array',
            'category' => 'nullable|string|max:100',
        ]);

        $blog = Blog::findOrFail($id);
        $tags = implode(',', $request->tag);

        // Mengambil dan memproses tanggal publish
        $publish = $request->published_at;
        $timestamp = $publish ? Carbon::parse($publish) : null;

        // DB Transaction untuk memastikan semua operasi sukses atau rollback
        DB::beginTransaction();

        try {
            $filename = $blog->thumbnail;

            // Jika ada file gambar yang diunggah, proses file tersebut
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = $request->plat . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/thumbnail', $filename);

                // Hapus gambar lama jika ada
                if ($blog->thumbnail) {
                    Storage::disk('local')->delete('public/thumbnail/' . $blog->thumbnail);
                }
            }

            $blog->update([
                'title' => $request->title,
                'content' => $request->content,
                'author' => $request->author,
                'published_at' => $timestamp,
                'thumbnail' => $filename,
                'tag' => $tags,
                'slug' => Str::slug($request->title),
                'category' => $request->category,
            ]);

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            return redirect()->back()->with(['success' => 'Blog updated successfully !!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            return redirect()->back()->with(['error' => 'Failed to update blog. Please try again later.']);
        }
    }

    public function cmsDestroyBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->back()->with(['success' => 'Blog deleted successfully !!']);
    }

    public function blogFileCreate(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('public/blog');
            $url = Storage::url($path);
            return Response::json(['url' => $url]);
        }
        return Response::json(['error' => 'No file uploaded'], 400);
    }

    public function blogFileUpdate()
    {
    }

    public function blogTagsCreate()
    {
    }

    public function blogTagsDelete()
    {
    }

    public function blogCategoriesCreate()
    {
    }

    public function blogCategoriesDelete()
    {
    }
}
