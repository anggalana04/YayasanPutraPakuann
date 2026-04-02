@extends('layouts.admin.app')

@section('title', 'Ubah Konten Yayasan')

@section('content')
<x-admin.cms-form-shell
	width="max-w-5xl"
	eyebrow="CMS Yayasan"
	:title="'Ubah ' . $page->title"
	:subtitle="'Slug: ' . $page->slug"
	:back-url="route('admin.cms.yayasan.index')"
>
	<form method="POST" action="{{ route('admin.cms.yayasan.update', ['page' => $page->id]) }}" class="space-y-5">
			@csrf
			@method('PUT')

			<div>
				<label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Judul Halaman</label>
				<input type="text" name="title" value="{{ old('title', $page->title) }}"
					   class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
					   required>
			</div>

			<div>
				<label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Konten HTML</label>
				<textarea name="content" rows="16"
						  class="mt-2 w-full bg-white border rounded-xl p-3 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-primary/20"
						  placeholder="Isi konten HTML yang ingin ditampilkan di halaman Yayasan...">{{ old('content', $page->content) }}</textarea>
				<p class="mt-1 text-xs text-on-surface-variant">Konten akan ditampilkan di atas halaman publik terkait jika status dipublish.</p>
			</div>

			<div class="grid grid-cols-12 gap-4">
				<div class="col-span-12 md:col-span-4">
					<label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Status</label>
					<select name="status" class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" required>
						<option value="draft" {{ old('status', $page->status) === 'draft' ? 'selected' : '' }}>Draf</option>
						<option value="published" {{ old('status', $page->status) === 'published' ? 'selected' : '' }}>Diterbitkan</option>
					</select>
				</div>
				<div class="col-span-12 md:col-span-8">
					<label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Meta Title</label>
					<input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}"
						   class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
						   placeholder="Opsional">
				</div>
			</div>

			<div>
				<label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Meta Description</label>
				<textarea name="meta_description" rows="3"
						  class="mt-2 w-full bg-white border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
						  placeholder="Opsional">{{ old('meta_description', $page->meta_description) }}</textarea>
			</div>

			<div class="flex gap-3 pt-2">
				<button type="submit"
						class="px-6 py-3 bg-primary text-on-primary font-bold rounded-2xl shadow-lg hover:shadow-xl active:scale-95 transition-all text-sm">
					Simpan Perubahan
				</button>
			</div>
		</form>
</x-admin.cms-form-shell>
@endsection





