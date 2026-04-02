@extends('layouts.SD.app')

@section('content')
<style>
/* Gallery Lightbox Styles */
.gallery-lightbox {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999999;
    animation: fadeIn 0.3s ease-out;
}

.gallery-lightbox.active {
    display: block;
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.95);
    backdrop-filter: blur(20px);
}

.gallery-container {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    z-index: 1;
}

.gallery-close-btn {
    position: absolute;
    top: 24px;
    right: 24px;
    width: 56px;
    height: 56px;
    background: rgba(239, 68, 68, 0.2);
    border: 2px solid rgba(239, 68, 68, 0.4);
    border-radius: 50%;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    z-index: 10;
}

.gallery-close-btn:hover {
    background: rgba(239, 68, 68, 0.4);
    transform: scale(1.1) rotate(90deg);
}

.gallery-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 64px;
    height: 64px;
    background: rgba(253, 185, 19, 0.2);
    border: 2px solid rgba(253, 185, 19, 0.4);
    border-radius: 50%;
    color: #FDB913;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    z-index: 10;
}

.gallery-nav-btn:hover {
    background: rgba(253, 185, 19, 0.4);
    transform: translateY(-50%) scale(1.1);
}

.gallery-nav-btn:active {
    transform: translateY(-50%) scale(0.95);
}

.gallery-nav-left {
    left: 24px;
}

.gallery-nav-right {
    right: 24px;
}

.gallery-nav-btn .material-symbols-outlined {
    font-size: 36px;
}

.gallery-image-wrapper {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 100px 120px 120px;
    overflow: hidden;
}

.gallery-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 12px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: grab;
    user-select: none;
    -webkit-user-drag: none;
}

.gallery-image:active {
    cursor: grabbing;
}

.gallery-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.95), rgba(0, 0, 0, 0.7), transparent);
    padding: 60px 40px 40px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 24px;
}

.gallery-info-content {
    flex: 1;
}

.gallery-category {
    display: inline-block;
    padding: 6px 12px;
    background: rgba(253, 185, 19, 0.2);
    border: 1px solid rgba(253, 185, 19, 0.4);
    border-radius: 20px;
    color: #FDB913;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
}

.gallery-title {
    color: white;
    font-size: 28px;
    font-weight: 800;
    margin: 0 0 8px 0;
    line-height: 1.3;
}

.gallery-counter {
    color: rgba(255, 255, 255, 0.6);
    font-size: 14px;
    font-weight: 600;
    margin: 0;
}

.gallery-actions {
    display: flex;
    gap: 12px;
}

.gallery-action-btn {
    width: 48px;
    height: 48px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    text-decoration: none;
}

.gallery-action-btn:hover {
    background: rgba(253, 185, 19, 0.3);
    border-color: rgba(253, 185, 19, 0.5);
    transform: translateY(-2px);
}

.gallery-loader {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    z-index: 5;
    display: none;
}

.gallery-loader.active {
    display: block;
}

.gallery-spinner {
    width: 60px;
    height: 60px;
    border: 4px solid rgba(253, 185, 19, 0.2);
    border-top: 4px solid #FDB913;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 768px) {
    .gallery-image-wrapper {
        padding: 80px 20px 160px;
    }

    .gallery-nav-btn {
        width: 48px;
        height: 48px;
    }

    .gallery-nav-btn .material-symbols-outlined {
        font-size: 28px;
    }

    .gallery-nav-left {
        left: 12px;
    }

    .gallery-nav-right {
        right: 12px;
    }

    .gallery-info {
        flex-direction: column;
        align-items: stretch;
        padding: 40px 20px 20px;
    }

    .gallery-title {
        font-size: 20px;
    }

    .gallery-actions {
        justify-content: center;
    }
}
</style>

<!-- Hero Section -->
<section class="py-16 px-6 lg:px-12 max-w-7xl mx-auto">
    <nav class="flex mb-8 text-sm font-medium text-slate-400 gap-2">
        <a class="hover:text-primary" href="{{ route('school.home', ['school' => 'sd']) }}">Beranda</a>
        <span>/</span>
        <span class="text-charcoal dark:text-white font-semibold">Galeri</span>
    </nav>
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-10">
        <div class="max-w-2xl">
            <h1 class="text-5xl md:text-7xl font-black tracking-tight text-charcoal dark:text-white mb-6">
                Lensa <span class="text-primary">Eksplorasi</span> Kami
            </h1>
            <p class="text-lg text-slate-500 dark:text-slate-300 leading-relaxed">
                Dokumentasi momen berharga, prestasi gemilang, dan inovasi siswa SDIT Putra Pakuan dalam menggapai masa depan yang cerah.
            </p>
        </div>
        {{-- <div class="flex gap-4">
            <button class="flex items-center gap-2 px-8 py-4 bg-white dark:bg-white/10 border border-primary/20 rounded-xl font-bold hover:bg-primary/10 dark:hover:bg-primary/10 transition-colors shadow-lg">
                <span class="material-symbols-outlined">upload</span>
                <span>Kirim Karya</span>
            </button>
        </div> --}}
    </div>
</section>

<!-- Categories Filter -->
<section class="py-8 px-6 lg:px-12 border-y border-primary/10 bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto flex items-center gap-4 overflow-x-auto hide-scrollbar">
        <a href="{{ route('school.galeri', ['school' => $school]) }}" class="px-8 py-3 {{ $filter === 'all' || empty($filter) ? 'bg-primary text-charcoal' : 'bg-slate-100 dark:bg-white/10 hover:bg-primary/20' }} rounded-full font-bold whitespace-nowrap shadow-md transition-all">Semua Media</a>
        <a href="{{ route('school.galeri', ['school' => $school, 'filter' => 'Acara Sekolah']) }}" class="px-8 py-3 {{ $filter === 'Acara Sekolah' ? 'bg-primary text-charcoal' : 'bg-slate-100 dark:bg-white/10 hover:bg-primary/20 dark:hover:bg-primary/20 border border-transparent' }} rounded-full font-semibold transition-all whitespace-nowrap">Acara Sekolah</a>
        <a href="{{ route('school.galeri', ['school' => $school, 'filter' => 'Laboratorium']) }}" class="px-8 py-3 {{ $filter === 'Laboratorium' ? 'bg-primary text-charcoal' : 'bg-slate-100 dark:bg-white/10 hover:bg-primary/20 dark:hover:bg-primary/20 border border-transparent' }} rounded-full font-semibold transition-all whitespace-nowrap">Laboratorium</a>
        <a href="{{ route('school.galeri', ['school' => $school, 'filter' => 'Prestasi Siswa']) }}" class="px-8 py-3 {{ $filter === 'Prestasi Siswa' ? 'bg-primary text-charcoal' : 'bg-slate-100 dark:bg-white/10 hover:bg-primary/20 dark:hover:bg-primary/20 border border-transparent' }} rounded-full font-semibold transition-all whitespace-nowrap">Prestasi Siswa</a>
        <a href="{{ route('school.galeri', ['school' => $school, 'filter' => 'Ekstrakurikuler']) }}" class="px-8 py-3 {{ $filter === 'Ekstrakurikuler' ? 'bg-primary text-charcoal' : 'bg-slate-100 dark:bg-white/10 hover:bg-primary/20 dark:hover:bg-primary/20 border border-transparent' }} rounded-full font-semibold transition-all whitespace-nowrap">Ekstrakurikuler</a>
        <a href="{{ route('school.galeri', ['school' => $school, 'filter' => 'Kunjungan Industri']) }}" class="px-8 py-3 {{ $filter === 'Kunjungan Industri' ? 'bg-primary text-charcoal' : 'bg-slate-100 dark:bg-white/10 hover:bg-primary/20 dark:hover:bg-primary/20 border border-transparent' }} rounded-full font-semibold transition-all whitespace-nowrap">Kunjungan Industri</a>
    </div>
</section>

<!-- Foto Terbaru Section -->
<section class="py-16 px-6 lg:px-12 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-10">
        <h2 class="text-3xl font-bold flex items-center gap-3">
            <span class="material-symbols-outlined text-primary">photo_library</span>
            Foto Terbaru
        </h2>
        {{-- <a href="{{ route('school.galeri', ['school' => $school]) }}" class="text-primary font-bold flex items-center gap-1 group text-lg">
            Lihat Semua <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
        </a> --}}
    </div>
    <div class="masonry-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse ($galleryItems as $index => $item)
        <div class="group relative cursor-pointer overflow-hidden rounded-xl bg-slate-100 dark:bg-white/5 shadow-md hover:shadow-2xl transition-all duration-300"
             onclick="openGalleryLightbox({{ $index }})">
            <img class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $item->title }}" src="{{ $item->image_url }}"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-5">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-primary text-xl">zoom_in</span>
                    <span class="text-primary text-xs font-bold uppercase tracking-widest">{{ $item->description ?? 'Galeri' }}</span>
                </div>
                <h3 class="text-white font-bold leading-tight text-lg line-clamp-2">{{ $item->title }}</h3>
            </div>
        </div>
        @empty
        <div class="md:col-span-3 text-center py-10">
            <p class="text-slate-500 dark:text-slate-400">Belum ada foto galeri untuk saat ini.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- Load More & Call to Action -->
<section class="py-24 px-6 text-center">
    <button id="loadMoreBtn" class="px-16 py-5 bg-primary text-charcoal font-black text-xl rounded-full shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all mb-16">
        MUAT LEBIH BANYAK
    </button>
    <div class="max-w-4xl mx-auto p-16 bg-primary rounded-xl flex flex-col md:flex-row items-center justify-between gap-10 text-charcoal">
        <div class="text-left">
            <h2 class="text-4xl font-black mb-2 leading-tight">Ingin menjadi bagian dari kami?</h2>
            <p class="font-medium opacity-80">Segera daftarkan dirimu dan raih masa depan gemilang di SDIT Putra Pakuan.</p>
        </div>
        <button class="bg-charcoal text-white px-12 py-5 rounded-full font-bold hover:bg-slate-800 transition-colors whitespace-nowrap text-lg">
            Daftar Online Sekarang
        </button>
    </div>
</section>

<!-- PROFESSIONAL GALLERY LIGHTBOX -->
<div id="galleryLightbox" class="gallery-lightbox">
    <div class="gallery-overlay"></div>
    <div class="gallery-container">
        <!-- Close Button -->
        <button id="closeLightboxBtn" class="gallery-close-btn" title="Tutup (ESC)">
            <span class="material-symbols-outlined">close</span>
        </button>

        <!-- Navigation Arrows -->
        <button id="prevImageBtn" class="gallery-nav-btn gallery-nav-left" title="Sebelumnya (?)">
            <span class="material-symbols-outlined">chevron_left</span>
        </button>
        <button id="nextImageBtn" class="gallery-nav-btn gallery-nav-right" title="Berikutnya (?)">
            <span class="material-symbols-outlined">chevron_right</span>
        </button>

        <!-- Image Container -->
        <div class="gallery-image-wrapper">
            <img id="lightboxImage" class="gallery-image" src="" alt="">
        </div>

        <!-- Image Info -->
        <div class="gallery-info">
            <div class="gallery-info-content">
                <span id="lightboxCategory" class="gallery-category"></span>
                <h3 id="lightboxTitle" class="gallery-title"></h3>
                <p id="lightboxCounter" class="gallery-counter"></p>
            </div>
            <div class="gallery-actions">
                <button id="zoomInBtn" class="gallery-action-btn" title="Perbesar (+)">
                    <span class="material-symbols-outlined">zoom_in</span>
                </button>
                <button id="zoomOutBtn" class="gallery-action-btn" title="Perkecil (-)">
                    <span class="material-symbols-outlined">zoom_out</span>
                </button>
                <button id="resetZoomBtn" class="gallery-action-btn" title="Reset (0)">
                    <span class="material-symbols-outlined">fit_screen</span>
                </button>
                <a id="downloadBtn" class="gallery-action-btn" download title="Unduh">
                    <span class="material-symbols-outlined">download</span>
                </a>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div id="lightboxLoader" class="gallery-loader">
            <div class="gallery-spinner"></div>
        </div>
    </div>
</div>

<!-- Hidden data for JavaScript -->
<script id="galleryData" type="application/json">
    {!! json_encode($galleryItems->items()) !!}
</script>
<script id="galleryMeta" type="application/json">
    {!! json_encode([
        'hasMore' => $galleryItems->hasMorePages(),
        'nextPage' => $galleryItems->currentPage() + 1,
        'currentFilter' => $filter,
        'school' => $school
    ]) !!}
</script>

<script>
// Gallery Lightbox Class
class GalleryLightbox {
    constructor() {
        this.lightbox = document.getElementById('galleryLightbox');
        this.image = document.getElementById('lightboxImage');
        this.title = document.getElementById('lightboxTitle');
        this.category = document.getElementById('lightboxCategory');
        this.counter = document.getElementById('lightboxCounter');
        this.loader = document.getElementById('lightboxLoader');
        this.downloadBtn = document.getElementById('downloadBtn');

        this.currentIndex = 0;
        this.currentZoom = 1;
        this.minZoom = 1;
        this.maxZoom = 3;
        this.zoomStep = 0.3;

        this.isDragging = false;
        this.startX = 0;
        this.startY = 0;
        this.translateX = 0;
        this.translateY = 0;

        // Load gallery data
        const dataElement = document.getElementById('galleryData');
        this.images = dataElement ? JSON.parse(dataElement.textContent) : [];

        this.initEventListeners();
    }

    initEventListeners() {
        // Close button
        document.getElementById('closeLightboxBtn').addEventListener('click', () => this.close());

        // Navigation
        document.getElementById('prevImageBtn').addEventListener('click', () => this.prev());
        document.getElementById('nextImageBtn').addEventListener('click', () => this.next());

        // Zoom controls
        document.getElementById('zoomInBtn').addEventListener('click', () => this.zoom(this.zoomStep));
        document.getElementById('zoomOutBtn').addEventListener('click', () => this.zoom(-this.zoomStep));
        document.getElementById('resetZoomBtn').addEventListener('click', () => this.resetZoom());

        // Click overlay to close
        this.lightbox.querySelector('.gallery-overlay').addEventListener('click', () => this.close());

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => this.handleKeyboard(e));

        // Mouse drag for panning
        this.image.addEventListener('mousedown', (e) => this.startDrag(e));
        document.addEventListener('mousemove', (e) => this.drag(e));
        document.addEventListener('mouseup', () => this.endDrag());

        // Mouse wheel zoom
        this.image.addEventListener('wheel', (e) => this.handleWheel(e));
    }

    open(index) {
        if (!this.images || this.images.length === 0) return;

        this.currentIndex = index;
        this.lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';

        this.loadImage();
    }

    loadImage() {
        const item = this.images[this.currentIndex];
        if (!item) return;

        // Show loader
        this.loader.classList.add('active');
        this.image.style.opacity = '0';

        // Reset zoom and position
        this.currentZoom = 1;
        this.translateX = 0;
        this.translateY = 0;
        this.updateTransform();

        // Load image
        const img = new Image();
        img.onload = () => {
            this.image.src = item.image_url;
            this.image.alt = item.title;
            this.title.textContent = item.title;
            this.category.textContent = item.description;
            this.counter.textContent = `${this.currentIndex + 1} / ${this.images.length}`;
            this.downloadBtn.href = item.image_url;
            this.downloadBtn.download = item.title || 'image';

            // Hide loader, show image
            setTimeout(() => {
                this.loader.classList.remove('active');
                this.image.style.opacity = '1';
            }, 200);
        };
        img.onerror = () => {
            this.loader.classList.remove('active');
            this.image.style.opacity = '1';
            console.error('Failed to load image');
        };
        img.src = item.image_url;
    }

    close() {
        this.lightbox.classList.remove('active');
        document.body.style.overflow = '';
        this.currentZoom = 1;
        this.translateX = 0;
        this.translateY = 0;
    }

    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        this.loadImage();
    }

    next() {
        this.currentIndex = (this.currentIndex + 1) % this.images.length;
        this.loadImage();
    }

    zoom(delta) {
        this.currentZoom = Math.max(this.minZoom, Math.min(this.maxZoom, this.currentZoom + delta));
        this.updateTransform();
    }

    resetZoom() {
        this.currentZoom = 1;
        this.translateX = 0;
        this.translateY = 0;
        this.updateTransform();
    }

    updateTransform() {
        this.image.style.transform = `scale(${this.currentZoom}) translate(${this.translateX}px, ${this.translateY}px)`;
    }

    startDrag(e) {
        if (this.currentZoom <= 1) return;
        this.isDragging = true;
        this.startX = e.clientX - this.translateX;
        this.startY = e.clientY - this.translateY;
        e.preventDefault();
    }

    drag(e) {
        if (!this.isDragging) return;
        this.translateX = e.clientX - this.startX;
        this.translateY = e.clientY - this.startY;
        this.updateTransform();
    }

    endDrag() {
        this.isDragging = false;
    }

    handleWheel(e) {
        e.preventDefault();
        const delta = e.deltaY > 0 ? -this.zoomStep : this.zoomStep;
        this.zoom(delta);
    }

    handleKeyboard(e) {
        if (!this.lightbox.classList.contains('active')) return;

        switch(e.key) {
            case 'Escape':
                this.close();
                break;
            case 'ArrowLeft':
                this.prev();
                break;
            case 'ArrowRight':
                this.next();
                break;
            case '+':
            case '=':
                this.zoom(this.zoomStep);
                break;
            case '-':
                this.zoom(-this.zoomStep);
                break;
            case '0':
                this.resetZoom();
                break;
        }
    }
}

// Initialize lightbox when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize lightbox
    const galleryLightbox = new GalleryLightbox();

    // Global function to open lightbox
    window.openGalleryLightbox = function(index) {
        galleryLightbox.open(index);
    };

    console.log('? Gallery Lightbox initialized with', galleryLightbox.images.length, 'images');

// Load More Functionality
class GalleryLoadMore {
    constructor() {
        this.loadMoreBtn = document.getElementById('loadMoreBtn');
        this.galleryGrid = document.querySelector('.masonry-grid');
        this.meta = JSON.parse(document.getElementById('galleryMeta').textContent);
        this.isLoading = false;

        if (this.loadMoreBtn) {
            this.loadMoreBtn.addEventListener('click', () => this.loadMore());
            this.updateButtonState();
        }
    }

    async loadMore() {
        if (this.isLoading || !this.meta.hasMore) return;

        this.isLoading = true;
        this.loadMoreBtn.disabled = true;
        this.loadMoreBtn.textContent = 'Memuat...';

        try {
            const params = new URLSearchParams({
                page: this.meta.nextPage,
                filter: this.meta.currentFilter
            });

            const response = await fetch(`/${this.meta.school}/galeri/load-more?${params}`);
            const data = await response.json();

            if (data.items && data.items.length > 0) {
                // Add new items to the grid
                data.items.forEach((item, index) => {
                    const itemHtml = this.createGalleryItemHtml(item, galleryLightbox.images.length + index);
                    this.galleryGrid.insertAdjacentHTML('beforeend', itemHtml);
                });

                // Update gallery data for lightbox
                galleryLightbox.images.push(...data.items);

                // Update meta data
                this.meta.hasMore = data.hasMore;
                this.meta.nextPage = data.nextPage;

                console.log('? Loaded', data.items.length, 'more gallery items');
            } else {
                this.meta.hasMore = false;
            }
        } catch (error) {
            console.error('? Error loading more gallery items:', error);
        } finally {
            this.isLoading = false;
            this.updateButtonState();
        }
    }

    createGalleryItemHtml(item, index) {
        return `
            <div class="group relative cursor-pointer overflow-hidden rounded-xl bg-slate-100 dark:bg-white/5 shadow-md hover:shadow-2xl transition-all duration-300"
                 onclick="openGalleryLightbox(${index})">
                <img class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-110" alt="${item.title}" src="${item.image_url}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-primary text-xl">zoom_in</span>
                        <span class="text-primary text-xs font-bold uppercase tracking-widest">${item.description || 'Galeri'}</span>
                    </div>
                    <h3 class="text-white font-bold leading-tight text-lg line-clamp-2">${item.title}</h3>
                </div>
            </div>
        `;
    }

    updateButtonState() {
        if (!this.loadMoreBtn) return;

        if (this.meta.hasMore) {
            this.loadMoreBtn.disabled = false;
            this.loadMoreBtn.textContent = 'MUAT LEBIH BANYAK';
        } else {
            this.loadMoreBtn.disabled = true;
            this.loadMoreBtn.textContent = 'TIDAK ADA LAGI';
            this.loadMoreBtn.style.opacity = '0.5';
        }
    }
}

// Initialize load more functionality
const galleryLoadMore = new GalleryLoadMore();

});
</script>
@endsection





