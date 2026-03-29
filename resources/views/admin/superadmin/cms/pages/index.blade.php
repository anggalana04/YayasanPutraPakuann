@extends('layouts.admin.app')

@section('title', 'CMS Yayasan')

@section('content')
<div class="p-10 max-w-7xl mx-auto space-y-6">
	<div class="flex justify-between items-end gap-4">
		<div>
			<p class="text-primary font-bold tracking-widest text-xs uppercase">Superadmin CMS</p>
			<h2 class="text-4xl font-extrabold tracking-tight text-[#1c190d]">Yayasan</h2>
			<p class="text-on-surface-variant max-w-2xl">Kelola konten halaman utama domain Yayasan Putra Pakuan.</p>
		</div>
		<a href="{{ route('admin.cms.schools') }}"
		   class="px-6 py-3 bg-white border border-primary/20 text-primary font-bold rounded-2xl hover:bg-primary/10 transition-all shadow-sm text-sm">
			Kembali ke Pilih Unit
		</a>
	</div>

	@if (session('success'))
		<div class="px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-bold">
			{{ session('success') }}
		</div>
	@endif

	<div class="bg-surface-container-lowest rounded-3xl p-5 shadow-sm ring-1 ring-[#1c190d]/5 overflow-x-auto">
		<table class="w-full text-left border-collapse">
			<thead>
				<tr class="bg-surface-container-low/50">
					<th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Halaman</th>
					<th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Slug</th>
					<th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Status</th>
					<th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70">Terakhir Update</th>
					<th class="px-4 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 text-right">Aksi</th>
				</tr>
			</thead>
			<tbody class="divide-y divide-[#1c190d]/5">
				@forelse ($pages as $item)
					<tr class="hover:bg-surface-container-low/30 transition-colors">
						<td class="px-4 py-4 font-bold text-[#1c190d]">{{ $item->title }}</td>
						<td class="px-4 py-4 text-on-surface-variant font-mono text-xs">{{ $item->slug }}</td>
						<td class="px-4 py-4">
							@if ($item->status === 'published')
								<span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Diterbitkan</span>
							@else
								<span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Draf</span>
							@endif
						</td>
						<td class="px-4 py-4 text-on-surface-variant text-sm">{{ $item->updated_at ? $item->updated_at->format('d M Y H:i') : '-' }}</td>
						<td class="px-4 py-4 text-right">
							<a href="{{ route('admin.cms.yayasan.edit', ['page' => $item->id]) }}"
							   class="px-3 py-2 bg-[#f2cc0d] text-[#1c190d] rounded-xl text-xs font-bold hover:scale-[1.02] transition-all inline-flex items-center gap-1">
								<span class="material-symbols-outlined text-sm">edit</span>
								Edit
							</a>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Belum ada halaman CMS Yayasan.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>
@endsection





