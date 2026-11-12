<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('articles')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string'],
        ], [
            'name.required' => 'Nama kelompok / kategori artikel wajib diisi.',
            'name.unique' => 'Nama kelompok / kategori sudah ada.',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'icon' => $request->icon ?: 'tag',
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kelompok artikel berhasil ditambahkan!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $category->id],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string'],
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'icon' => $request->icon ?: 'tag',
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kelompok artikel berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        if ($category->articles()->count() > 0) {
            return back()->with('error', 'Kategori ini tidak dapat dihapus karena masih memiliki ' . $category->articles()->count() . ' artikel terkait.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kelompok artikel berhasil dihapus.');
    }
}
