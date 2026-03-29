@extends('layouts.admin.app')

@section('title', 'Ubah Konten Yayasan')

@section('content')
<div class="p-10 max-w-5xl mx-auto space-y-6">
	<div class="flex justify-between items-end gap-4">
		<div>
			<p class="text-primary font-bold tracking-widest text-xs uppercase">CMS Yayasan</p>
			<h2 class="text-3xl font-extrabold tracking-tight text-[#1c190d]">Ubah {{ $page->title }}</h2>
			<p class="text-on-surface-variant">Slug: <span class="font-mono text-xs">{{ $page->slug }}</span></p>
		</div>
		<a href="{{ route('admin.cms.yayasan.index') }}"
		   class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
			Kembali
		</a>
	</div>

	@if ($errors->any())
		<div class="px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
			<ul class="list-disc ml-5">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm ring-1 ring-[#1c190d]/5">
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
						<option value="Draf" {{ old('status', $page->status) === 'draft' ? 'selected' : '' }}>Draf</option>
						<option value="Diterbitkan" {{ old('status', $page->status) === 'published' ? 'selected' : '' }}>Diterbitkan</option>
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
	</div>
</div>
@endsection





