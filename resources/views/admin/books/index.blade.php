@extends('layouts.admin')
@section('title', __('message.books_management'))
@section('content')
  <div x-data="{
            showDeleteModal: false,
            deleteUrl: '',
            bookName: '',
            previews: [],
            isUploading: false,
            showSizeWarning: false,
            sizeWarningMsg: '',
            confirmDelete(url, name) {
                this.deleteUrl = url;
                this.bookName = name;
                this.showDeleteModal = true;
            },
            async handleFiles(event) {
                const files = Array.from(event.target.files);
                if (files.length === 0) return;

                const MAX_TOTAL_SIZE = 200 * 1024 * 1024;
                let currentTotalSize = 0;
                this.previews = [];

                for (let file of files) {
                    if (currentTotalSize + file.size > MAX_TOTAL_SIZE) {
                        const sizeMB = (file.size / 1024 / 1024).toFixed(2);
                        this.sizeWarningMsg = `{{ __('message.upload_size_warning') }}`.replace(':size', sizeMB).replace(':limit', '200');
                        this.showSizeWarning = true;
                        continue;
                    }
                    currentTotalSize += file.size;

                    const previewItem = {
                        file: file,
                        name: file.name,
                        thumb: null,
                        size: (file.size / 1024 / 1024).toFixed(2) + ' MB'
                    };
                    this.previews.push(previewItem);

                    if (file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf')) {
                        this.generateThumb(file).then(thumb => {
                            previewItem.thumb = thumb;
                        }).catch(e => console.warn('Thumbnail generation failed', e));
                    }
                }
                this.syncFileInput();
            },
            async generateThumb(file) {
                try {
                    const arrayBuffer = await file.arrayBuffer();
                    const loadingTask = pdfjsLib.getDocument({ data: arrayBuffer });
                    const pdf = await loadingTask.promise;
                    const page = await pdf.getPage(1);
                    const viewport = page.getViewport({ scale: 0.4 });
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    await page.render({ canvasContext: context, viewport: viewport }).promise;
                    return canvas.toDataURL();
                } catch (e) {
                    return null;
                }
            },
            removePreview(index) {
                this.previews.splice(index, 1);
                this.syncFileInput();
            },
            syncFileInput() {
                const input = document.querySelector('input[name=\'books[]\']');
                if (!input) return;
                const dt = new DataTransfer();
                this.previews.forEach(item => {
                    if (item.file) dt.items.add(item.file);
                });
                input.files = dt.files;
            }
        }">
    <div
      class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
          <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
          </svg>
          {{ __('message.books_management') }}
        </h3>
      </div>

      {{-- Upload Section --}}
      <div class="mb-8 p-4 bg-indigo-50 dark:bg-slate-800 rounded-xl border border-indigo-100 dark:border-gray-700">
        <h4 class="text-md font-semibold text-indigo-900 dark:text-indigo-300 mb-3 flex items-center gap-2">
          <i class="fa-solid fa-cloud-arrow-up"></i>
          {{ __('message.upload_new_books') }}
        </h4>
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data"
          @submit="isUploading = true" class="flex flex-col gap-4">
          @csrf
          <div class="flex flex-col md:flex-row gap-3">
            <div class="flex-grow">
              <input type="file" name="books[]" accept=".pdf" required multiple @change="handleFiles"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 px-2 h-10">
              @error('books')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
              @enderror
              @error('books.*')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
              @enderror
              <p class="mt-1 text-[10px] text-indigo-400">{{ __('message.can_select_multiple_pdf') }}</p>
            </div>
            <button type="submit" :disabled="isUploading"
              class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center justify-center gap-2 h-10 disabled:opacity-70">
              <template x-if="!isUploading">
                <div class="flex items-center gap-2">
                  <i class="fa-solid fa-plus"></i>
                  {{ __('message.upload_books') }}
                </div>
              </template>
              <template x-if="isUploading">
                <div class="flex items-center gap-2">
                  <i class="fa-solid fa-spinner fa-spin"></i>
                  {{ __('message.uploading') }}
                </div>
              </template>
            </button>
          </div>

          {{-- Selection Preview Area --}}
          <template x-if="previews.length > 0">
            <div class="mt-4 p-4 bg-white dark:bg-gray-900 rounded-lg border border-indigo-200 dark:border-gray-700">
              <h5 class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-3 uppercase tracking-wider">
                {{ __('message.items_to_be_uploaded') }}
              </h5>
              <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-5 lg:grid-cols-8 gap-4">
                <template x-for="(item, index) in previews" :key="index">
                  <div class="relative group animate-in fade-in zoom-in duration-300">
                    <div
                      class="aspect-[3/4] rounded-lg border-2 border-indigo-100 dark:border-gray-700 overflow-hidden bg-gray-50 dark:bg-gray-800 shadow-sm transition-all group-hover:border-indigo-400 relative">
                      {{-- Remove Button --}}
                      <button type="button" @click="removePreview(index)"
                        class="absolute top-1 right-1 z-10 size-5 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600 shadow-md">
                        <i class="fa-solid fa-xmark text-[10px]"></i>
                      </button>

                      <template x-if="item.thumb">
                        <img :src="item.thumb" class="w-full h-full object-cover">
                      </template>
                      <template x-if="!item.thumb">
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                          <i class="fa-solid fa-circle-notch fa-spin text-3xl mb-1"></i>
                          <span class="text-[8px]">{{ __('message.processing') }}</span>
                        </div>
                      </template>
                    </div>
                    <div class="mt-1 px-1">
                      <p class="text-[10px] font-bold text-gray-700 dark:text-gray-300 truncate" x-text="item.name"></p>
                      <p class="text-[9px] text-gray-400" x-text="item.size"></p>
                    </div>
                  </div>
                </template>
              </div>
            </div>
          </template>
        </form>
      </div>

      {{-- Books Grid --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6">
        @forelse ($books as $book)
          <div
            class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow group">
            <div class="aspect-[3/4] bg-gray-100 dark:bg-gray-900 relative overflow-hidden">
              @if ($book['thumbnail'])
                <img src="{{ $book['thumbnail'] }}" alt="{{ $book['name'] }}" class="w-full h-full object-cover">
              @else
                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                  <i class="fa-solid fa-file-pdf text-5xl mb-2"></i>
                  <span class="text-xs">{{ __('message.no_thumbnail') }}</span>
                </div>
              @endif
              <div
                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                <a href="{{ $book['url'] }}" target="_blank"
                  class="p-6 bg-white rounded-lg text-indigo-600 hover:scale-110 transition-transform shadow-lg"
                  title="{{ __('message.view_pdf') }}">
                  <i class="fa-solid fa-eye text-xl"></i>
                </a>
                <button type="button"
                  @click="confirmDelete('{{ route('admin.books.destroy', $book['filename']) }}', '{{ $book['name'] }}')"
                  class="p-6 bg-white rounded-lg text-red-600 hover:scale-110 transition-transform shadow-lg"
                  title="{{ __('message.delete') }}">
                  <i class="fa-solid fa-trash text-xl"></i>
                </button>
              </div>
            </div>
            <div class="p-4">
              <h5 class="font-bold text-gray-800 dark:text-gray-200 line-clamp-2 min-h-[3rem]" title="{{ $book['name'] }}">
                {{ $book['name'] }}
              </h5>
              <div class="mt-2 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                <span class="flex items-center gap-1">
                  <i class="fa-solid fa-hard-drive"></i>
                  {{ $book['size'] }}
                </span>
                <span class="flex items-center gap-1">
                  <i class="fa-solid fa-calendar-day"></i>
                  {{ date('d M Y', strtotime($book['last_modified'])) }}
                </span>
              </div>
            </div>
          </div>
        @empty
          <div class="col-span-full py-12 text-center">
            <div class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-xl">
              <div class="mx-auto h-16 w-16 rounded-full bg-gray-50 dark:bg-slate-700 flex items-center justify-center">
                <i class="fa-solid fa-book-open text-gray-400 text-3xl"></i>
              </div>
              <h3 class="mt-4 text-lg font-medium text-gray-500 dark:text-gray-400">{{ __('message.no_books_found') }}</h3>
              <p class="mt-1 text-sm text-gray-400">{{ __('message.upload_your_first_pdf_book_above') }}</p>
            </div>
          </div>
        @endforelse
      </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div x-show="showDeleteModal" x-cloak x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="fixed inset-0 backdrop-blur-sm bg-black/40 flex items-center justify-center z-50 p-4">
      <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        @click.away="showDeleteModal = false"
        class="bg-white dark:bg-gray-800 p-8 rounded-[2rem] shadow-2xl border border-white/20 dark:border-gray-700 w-full max-w-md">
        <div class="text-center">
          <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-red-100 dark:bg-red-900/30 mb-6">
            <i class="fa-solid fa-trash text-red-600 dark:text-red-400 text-3xl"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">{{ __('message.delete_book') }}</h3>
          <p class="text-gray-500 dark:text-gray-400 mb-8 text-lg">
            {{ __('message.are_you_sure_to_delete') }} <span class="font-bold text-gray-800 dark:text-gray-200"
              x-text="bookName"></span>?
            <br>
            <span class="text-sm mt-2 block">{{ __('message.this_action_cannot_be_undone') }}</span>
          </p>
          <div class="flex justify-center gap-4">
            <button @click="showDeleteModal = false"
              class="px-8 py-2 rounded-xl border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all font-bold text-base">
              {{ __('message.cancel') }}
            </button>
            <form :action="deleteUrl" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="px-8 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white shadow-lg shadow-red-500/30 transition-all font-bold text-base">
                {{ __('message.delete') }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- Upload Size Warning Modal --}}
    <div x-show="showSizeWarning" x-cloak x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="fixed inset-0 backdrop-blur-sm bg-black/40 flex items-center justify-center z-[60] p-4">
      <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        @click.away="showSizeWarning = false"
        class="bg-white dark:bg-gray-800 p-8 rounded-[2rem] shadow-2xl border border-white/20 dark:border-gray-700 w-full max-w-md">
        <div class="text-center">
          <div
            class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-amber-100 dark:bg-amber-900/30 mb-6">
            <i class="fa-solid fa-triangle-exclamation text-amber-600 dark:text-amber-400 text-3xl"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">{{ __('message.warning') }}</h3>
          <p class="text-gray-500 dark:text-gray-400 mb-8 text-lg" x-text="sizeWarningMsg"></p>
          <div class="flex justify-center">
            <button @click="showSizeWarning = false"
              class="px-8 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white shadow-lg shadow-amber-500/30 transition-all font-bold text-base">
              {{ __('message.close') }}
            </button>
          </div>
        </div>
      </div>
    </div>

    {{-- Global Loading Overlay --}}
    <div x-show="isUploading" x-cloak
      class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] flex items-center justify-center">
      <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-2xl flex flex-col items-center gap-4">
        <div class="relative">
          <div
            class="w-16 h-16 border-4 border-indigo-100 dark:border-gray-700 border-t-indigo-600 rounded-full animate-spin">
          </div>
          <i
            class="fa-solid fa-cloud-arrow-up absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-indigo-600 text-xl"></i>
        </div>
        <p class="text-xl font-bold text-gray-800 dark:text-white">{{ __('message.uploading') }}</p>
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('message.do_not_close_window') }}</p>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
  <script>
    const pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
  </script>
@endpush