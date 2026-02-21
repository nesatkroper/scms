@extends('layouts.admin')

@section('title', __('message.classrooms_list'))

@section('content')
  <div x-data="{
        showDeleteModal: false,
        deleteUrl: '',
        classroomName: '',
        confirmDelete(url, name) {
            this.deleteUrl = url;
            this.classroomName = name;
            this.showDeleteModal = true;
        }
    }">

    <div
      class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
      <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon for Classrooms (using a location/room theme) --}}
        <div
          class="size-8 rounded-full flex justify-center items-center p-1 bg-cyan-50 text-cyan-600 dark:text-cyan-50 dark:bg-cyan-900">
          <i class="fa-solid fa-people-roof"></i>
        </div>
        {{ __('message.classrooms_list') }}
      </h3>

      {{-- Success/Error Messages --}}
      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
          <span class="block sm:inline">{{ session('success') }}</span>
        </div>
      @endif
      @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
          <span class="block sm:inline">{{ session('error') }}</span>
        </div>
      @endif

      <form action="{{ route('admin.classrooms.index') }}" method="GET">
        <div
          class="p-2 md:flex gap-2 justify-between items-center border rounded-lg border-gray-200 dark:border-gray-700 bg-cyan-50 dark:bg-slate-800">

          {{-- Create Button (Redirects to Create Page) --}}
          @if (Auth::user()->hasPermissionTo('create_classroom'))
            <a href="{{ route('admin.classrooms.create') }}"
              class="text-nowrap p-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
              <i class="fa-solid fa-plus"></i>
              {{ __('message.create_new') }}
            </a>
          @endif

          <div class="flex items-center mt-3 md:mt-0 gap-2 min-w-2/3">
            <div class="relative w-full">
              <input type="search" name="search" id="searchInput"
                placeholder="{{ __('message.search_classrooms_(name_or_room_number)') }}" class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                  focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100"
                value="{{ request('search') }}">
              <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
            </div>

            <button type="submit"
              class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-600 dark:bg-indigo-700 hover:bg-indigo-700 dark:hover:bg-indigo-600 rounded-lg transition-colors text-white"
              title="{{ __('message.search') }}">
              <i class="fas fa-search text-white text-xs"></i>
            </button>
            <a href="{{ route('admin.classrooms.index') }}" id="resetSearch"
              class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-lg transition-colors dark:text-white"
              style="margin-top: 0 !important" title="{{ __('message.reset_search') }}">
              <i class="fa-solid fa-arrow-rotate-right"></i>
            </a>
          </div>
        </div>
      </form>

      {{-- Classroom Cards --}}
      <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
        @forelse ($classrooms as $classroom)
          <div
            class="bg-white dark:bg-slate-800 rounded-lg shadow border-3 border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300 @if ($classroom->deleted_at) border-3 border-dashed border-red-400 dark:border-red-500 @endif">

            <div class="p-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
              <div class="flex justify-between items-start gap-2">
                <div>
                  <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200">{{ $classroom->name }}
                    @if ($classroom->deleted_at)
                      <strong class="text-red-400"> {{ __('message.disabled_label') }}</strong>
                    @endif
                  </h4>
                </div>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                  {{ __('message.room_number') }}<span class="font-medium text-indigo-500 dark:text-indigo-400">
                    {{ $classroom->room_number }}
                  </span>
                </p>

                {{-- Detail Button (Redirects to Show Page) --}}
                {{-- <a href="{{ route('admin.classrooms.show', $classroom->id) }}"
                  class="btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-blue-500 hover:bg-blue-100 dark:hover:bg-gray-900 transition-colors"
                  title="View Details">
                  <span class="btn-content">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </span>
                </a> --}}
              </div>

            </div>

            <div class="p-4 space-y-3">
              {{-- Capacity --}}
              <div class="flex items-center gap-3 text-sm">
                <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M17 20h5v-2a3 3 0 00-3-3h-2a3 3 0 00-3 3v2h5zM7 20H2v-2a3 3 0 013-3h2a3 3 0 013 3v2H7zM10 10a3 3 0 100-6 3 3 0 000 6z" />
                  </svg>
                </div>
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('message.capacity') }}</p>
                  <p class="font-medium text-gray-700 dark:text-gray-200">
                    <span class="text-sm text-indigo-600 dark:text-indigo-400">{{ $classroom->capacity }}
                      {{ __('message.seats') }}</span>
                  </p>
                </div>
              </div>
            </div>

            {{-- Actions ({{ __('message.edit') }} Link + Delete Form) --}}
            <div
              class="px-4 py-1 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-2">

              @if (Auth::user()->hasPermissionTo('update_classroom'))
                <a href="{{ route('admin.classrooms.edit', $classroom->id) }}"
                  class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                  title="{{ __('message.edit') }}">
                  <span class="btn-content flex items-center justify-center">
                    <i class="fa-solid fa-pen-to-square me-2"></i>
                    {{ __('message.edit') }}
                  </span>
                </a>
              @endif

              {{-- Delete Button (Full form submission) --}}
              @if ($classroom->deleted_at)
                <form action="{{ route('admin.classrooms.restore', $classroom->id) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <button type="submit"
                    class="delete-btn p-2 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                    title="Delete">
                    <i class="fa-solid fa-trash-arrow-up me-2"></i>
                    {{ __('message.restore') }}
                  </button>
                </form>
              @else
                <form action="{{ route('admin.classrooms.destroy', $classroom->id) }}" method="POST"
                  @submit.prevent="confirmDelete($el.action, '{{ $classroom->name }}')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="delete-btn p-2 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                    title="Delete">
                    <i class="fa-solid fa-ban me-2"></i>
                    {{ __('message.disabled') }}
                  </button>
                </form>
              @endif

            </div>
          </div>
        @empty
          <div class="col-span-full py-12 text-center">
            <div
              class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
              <div class="mx-auto h-16 w-16 rounded-full bg-red-50 dark:bg-slate-700 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-400 dark:text-red-500" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">
                {{ __('message.no_classrooms_found') }}
              </h3>
              <p class="mt-1 text-sm text-red-500 dark:text-red-500">
                {{ __('message.create_your_first_classroom_to_get_started') }}
              </p>
            </div>
          </div>
        @endforelse
      </div>

      <div class="mt-6">
        {{ $classrooms->onEachSide(2)->links('admin.components.tailwind-modern') }}
      </div>

    </div>

    {{-- Delete Confirmation Modal --}}
    <div x-show="showDeleteModal" x-cloak x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="fixed inset-0 backdrop-blur-sm bg-black/40 flex items-center justify-center z-50 p-4">
      <div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" @click.away="showDeleteModal = false"
        class="bg-white dark:bg-gray-800 p-4 rounded-[2rem] shadow-2xl border border-white/20 dark:border-gray-700 w-full max-w-md">
        <div class="text-center">
          <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-red-100 dark:bg-red-900/30 mb-6">
            <i class="fa-solid fa-triangle-exclamation text-red-600 dark:text-red-400 text-3xl"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">{{ __('message.confirm_deletion') }}</h3>
          <p class="text-gray-500 dark:text-gray-400 mb-8 text-lg">
            {{ __('message.are_you_sure_to_delete') }} <span class="font-bold text-gray-800 dark:text-gray-200"
              x-text="classroomName"></span>?
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
  </div>
@endsection