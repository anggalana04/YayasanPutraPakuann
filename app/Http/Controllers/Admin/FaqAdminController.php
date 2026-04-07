<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\School;
use App\Traits\ResolvesSchool;
use Illuminate\Http\Request;

class FaqAdminController extends Controller
{
    use ResolvesSchool;

    public function index(string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();
        $faqs = Faq::where('school_id', $school->id)
            ->orderBy('sort_order')
            ->orderBy('created_at')
            ->get();

        return view('admin.superadmin.cms.unit.faq.index', compact('schoolType', 'school', 'faqs'));
    }

    public function store(Request $request, string $schoolType)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();

        $validated = $request->validate([
            'question'   => ['required', 'string', 'max:500'],
            'answer'     => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active'  => ['nullable', 'boolean'],
        ]);

        $maxOrder = Faq::where('school_id', $school->id)->max('sort_order') ?? -1;

        Faq::create([
            'school_id'  => $school->id,
            'question'   => $validated['question'],
            'answer'     => $validated['answer'],
            'sort_order' => $validated['sort_order'] ?? ($maxOrder + 1),
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.cms.faq.index', ['schoolType' => $schoolType])
            ->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(string $schoolType, Faq $faq)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();
        abort_if($faq->school_id !== $school->id, 404);

        return view('admin.superadmin.cms.unit.faq.form', compact('schoolType', 'school', 'faq'));
    }

    public function update(Request $request, string $schoolType, Faq $faq)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();
        abort_if($faq->school_id !== $school->id, 404);

        $validated = $request->validate([
            'question'   => ['required', 'string', 'max:500'],
            'answer'     => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active'  => ['nullable', 'boolean'],
        ]);

        $faq->update([
            'question'   => $validated['question'],
            'answer'     => $validated['answer'],
            'sort_order' => $validated['sort_order'] ?? $faq->sort_order,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.cms.faq.index', ['schoolType' => $schoolType])
            ->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(string $schoolType, Faq $faq)
    {
        $this->abortUnlessAdmin();

        $school = School::where('type', School::resolveDbType($schoolType))->firstOrFail();
        abort_if($faq->school_id !== $school->id, 404);

        $faq->delete();

        return redirect()
            ->route('admin.cms.faq.index', ['schoolType' => $schoolType])
            ->with('success', 'FAQ berhasil dihapus.');
    }

    private function abortUnlessAdmin(): void
    {
        $user = auth('admin')->user();
        if (! $user || ! $user->is_admin) {
            abort(403);
        }
    }
}
