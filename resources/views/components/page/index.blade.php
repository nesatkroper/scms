@extends('layouts.admin')

@section('title', $title)

@section('content')
  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    {{-- Page Title Section --}}
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="{{ $iconSvgPath }}" clip-rule="evenodd" />
      </svg>
      {{ $title }}
    </h3>

    {{-- Create Button Section --}}
    <div
      class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">
      <button id="openCreateModal"
        class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="{{ $createButtonIconSvgPath }}" clip-rule="evenodd" />
        </svg>
        {{ $createButtonText }}
      </button>
      {{-- This is where other page-specific action buttons or search bars can be added via the slot --}}
    </div>

    {{-- Main Content Slot --}}
    {{ $slot }}

  </div>

  {{-- Generic Modal Backdrop (remains here as it's a global overlay) --}}
  <div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>

@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      console.log('DOM Content Loaded - Initializing generic Page Index scripts.');

      // Ensure jQuery AJAX setup for CSRF token (if jQuery is used globally)
      if (typeof $ !== 'undefined') {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      }

      // --- Generic Modal Functions (remain here) ---

      // Function to show a modal
      window.showModal = function(modalId) {
        console.log(`showModal called for: ${modalId}`);
        const backdrop = document.getElementById('modalBackdrop');
        const modal = document.getElementById(modalId);

        if (backdrop) {
          backdrop.classList.remove('hidden');
          console.log('Backdrop hidden class removed.');
        } else {
          console.error('Error: modalBackdrop element not found!');
        }

        if (modal) {
          modal.classList.remove('hidden');
          console.log(`Modal ${modalId} hidden class removed.`);
          setTimeout(() => {
            const innerDiv = modal.querySelector('div'); // Targets the direct child div for transitions
            if (innerDiv) {
              innerDiv.classList.remove('opacity-0', 'scale-95');
              innerDiv.classList.add('opacity-100', 'scale-100');
              console.log(`Modal ${modalId} inner div transition classes applied.`);
            } else {
              console.error(`Error: Inner div for modal ${modalId} not found!`);
            }
          }, 10);
          document.body.style.overflow = 'hidden';
          console.log('Body overflow set to hidden.');
        } else {
          console.error(`Error: Modal element with ID "${modalId}" not found!`);
        }
      };

      // Function to close a modal
      window.closeModal = function(modalId) {
        console.log(`closeModal called for: ${modalId}`);
        const modal = document.getElementById(modalId);
        const backdrop = document.getElementById('modalBackdrop');

        if (modal) {
          const innerDiv = modal.querySelector('div');
          if (innerDiv) {
            innerDiv.classList.remove('opacity-100', 'scale-100');
            innerDiv.classList.add('opacity-0', 'scale-95');
          }

          setTimeout(() => {
            modal.classList.add('hidden');
            if (backdrop) {
              backdrop.classList.add('hidden');
            }
            document.body.style.overflow = 'auto';
          }, 300); // Match this duration with your CSS transition duration
        }
      };

      // Global function for displaying task messages (toasts)
      window.ShowTaskMessage = function(type, message) {
        const TasksmsContainer = document.createElement('div');
        TasksmsContainer.className = `fixed top-5 right-4 z-50 animate-fade-in-out`;
        TasksmsContainer.innerHTML = `
                    <div>
                        <div class="flex items-start gap-3 ${type === 'success' ? 'bg-green-200/80 dark:bg-green-900/60 border-green-400 dark:border-green-600 text-green-700 dark:text-green-300' : 'bg-red-200/80 dark:bg-red-900/60 border-red-400 dark:border-red-600 text-red-700 dark:text-red-300'}
                            border backdrop-blur-sm px-4 py-3 rounded-lg shadow-lg">
                            <svg class="w-6 h-6 flex-shrink-0 ${type === 'success' ? 'text-green-500 dark:text-green-400' : 'text-red-500 dark:text-red-400'} mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="${type === 'success' ? 'M5 13l4 4L19 7' : 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'}" />
                            </svg>
                            <div class="flex-1 text-sm sm:text-base">${message}</div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-gray-600 rounded-full dark:text-gray-400 hover:bg-gray-100/30 dark:hover:bg-gray-50/10 focus:outline-none">
                                <svg class="w-5 h-5 rounded-full" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
        document.body.appendChild(TasksmsContainer);
        setTimeout(() => TasksmsContainer.remove(), 3000);
      };

      // Function to re-initialize custom select fields (important after AJAX content refresh)
      window.selectfields = function() {
        document.querySelectorAll('.custom-select').forEach(select => {
          const header = select.querySelector('.select-header');
          const optionsBox = select.querySelector('.select-options');
          const searchInput = select.querySelector('.search-input');
          const selectedValue = select.querySelector('.selected-value');
          const noResults = select.querySelector('.no-results');
          const options = Array.from(select.querySelectorAll('.select-option'));
          const hiddenInput = select.querySelector(
          `input[name="${select.dataset.name}"]`); // Find hidden input within the same select

          // Clone and replace elements to remove old event listeners
          const cloneHeader = header.cloneNode(true);
          header.parentNode.replaceChild(cloneHeader, header);
          const newHeader = cloneHeader;

          const cloneSearchInput = searchInput.cloneNode(true);
          searchInput.parentNode.replaceChild(cloneSearchInput, searchInput);
          const newSearchInput = cloneSearchInput;

          // Re-attach listeners to new elements
          newHeader.addEventListener('click', function() {
            select.classList.toggle('open');
            if (select.classList.contains('open')) {
              newSearchInput.focus();
            }
          });

          newSearchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase().trim();
            let hasMatch = false;

            options.forEach(option => {
              if (option.textContent.toLowerCase().includes(term)) {
                option.style.display = 'block';
                hasMatch = true;
              } else {
                option.style.display = 'none';
              }
            });

            noResults.style.display = hasMatch ? 'none' : 'block';
          });

          options.forEach(option => {
            // Remove existing listeners before re-attaching
            const cloneOption = option.cloneNode(true);
            option.parentNode.replaceChild(cloneOption, option);
            cloneOption.addEventListener('click', function() {
              options.forEach(opt => opt.classList.remove('selected'));
              this.classList.add('selected');
              selectedValue.textContent = this.textContent;
              hiddenInput.value = this.dataset.value;
              select.classList.remove('open');
              console.log('Selected value:', this.dataset.value);
            });
          });
        });
      };

      // Global document click listener for closing custom select dropdowns
      function handleDocumentClickForSelects(e) {
        document.querySelectorAll('.custom-select').forEach(select => {
          if (!select.contains(e.target)) {
            select.classList.remove('open');
          }
        });
      }
      document.addEventListener('click', handleDocumentClickForSelects); // Attach once

      // Initialize custom select fields on page load
      selectfields();

      // Generic modal close listeners (for buttons with 'close' or 'cancel' in ID, or escape key)
      // These can be attached here as they are generic modal behaviors.
      $('[id^="close"], [id^="cancel"]').on('click', function() {
        const modalId = $(this).closest('[id^="Modal"]').attr('id') ||
          $(this).closest('[id$="Modal"]').attr('id');
        if (modalId) closeModal(modalId);
      });

      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          $('[id^="Modal"]').each(function() {
            if (!$(this).hasClass('hidden')) {
              closeModal(this.id);
            }
          });
        }
      });
    });
  </script>
@endpush
