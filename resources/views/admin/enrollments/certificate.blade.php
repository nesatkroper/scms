@extends('layouts.admin')

@section('title', 'វិញ្ញាបនបត្រ - Certificate')

@section('content')
  <!-- Add Google Fonts for Khmer -->
  <link
    href="https://fonts.googleapis.com/css2?family=Dangrek&family=Freehand&family=Kantumruy+Pro:wght@400;700&family=Moul&family=Siemreap&display=swap"
    rel="stylesheet">

  <div class="container mx-auto px-4 py-8 no-print">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Certificate Preview</h2>
      <div class="flex gap-4">
        <button onclick="window.print()"
          class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center gap-2">
          <i class="fa-solid fa-print"></i>
          បោះពុម្ព (Print)
        </button>
        <a href="{{ route('admin.enrollments.index', ['course_offering_id' => $enrollment->course_offering_id]) }}"
          class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 flex items-center gap-2">
          <i class="fa-solid fa-arrow-left"></i>
          ត្រឡប់ក្រោយ (Back)
        </a>
      </div>
    </div>
  </div>

  <div class="certificate-container shadow-2xl mx-auto bg-white">
    <div class="pattern-border">
      <div class="double-line-frame">
        <div class="inner-content p-10 relative">

          {{-- Header Section --}}
          <div class="grid grid-cols-3 items-start mb-4">
            {{-- Left Header --}}
            <div class="text-center flex flex-col items-center">
              <img src="{{ asset('assets/images/scms.png') }}" alt="School Logo" class="h-20 object-contain mb-1">
              <h4 class="khmer-moul text-[12px] text-blue-900">សាលា ភ្នំពេញ (SCMS)</h4>
              <p class="khmer-siemreap text-[10px] text-blue-800 font-bold">
                លេខ:......{{ str_pad($enrollment->id, 3, '0', STR_PAD_LEFT) }}......ស.ភ.ព</p>
            </div>

            {{-- Center Header --}}
            <div class="text-center">
              <h3 class="khmer-moul text-2xl text-blue-900 uppercase">ព្រះរាជាណាចក្រកម្ពុជា</h3>
              <h4 class="khmer-moul text-lg text-blue-900 mt-1">ជាតិ សាសនា ព្រះមហាក្សត្រ</h4>
              <div class="mt-1 flex justify-center opacity-70">
                <svg width="100" height="10" viewBox="0 0 100 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 5C20 5 30 0 50 5C70 10 80 5 100 5" stroke="#1e3a8a" stroke-width="1" />
                </svg>
              </div>
            </div>

            {{-- Right Header --}}
            <div class="text-right flex flex-col items-end">
              <div class="flex flex-col items-center">
                <span class="text-xl font-bold tracking-tighter text-blue-900 italic">SCMS</span>
                <span class="text-[8px] uppercase tracking-widest text-blue-800 font-bold">Kingdom of Excellence</span>
              </div>
            </div>
          </div>

          {{-- Certificate Title --}}
          <div class="text-center mb-8">
            <h1 class="khmer-moul text-4xl text-blue-900">វិញ្ញាបនបត្របញ្ជាក់ការសិក្សា</h1>
            <p class="text-xl font-bold text-gray-800 tracking-wider font-serif uppercase mt-1">Certificate of Achievement
            </p>
          </div>

          {{-- Main Content 2 Columns --}}
          <div class="grid grid-cols-2 gap-10">
            {{-- Left Column (Khmer) --}}
            <div class="space-y-4">
              <div class="flex items-baseline gap-2">
                <span class="khmer-moul text-sm text-blue-900 w-24 whitespace-nowrap">ទទួលបាន៖</span>
                <span
                  class="khmer-siemreap font-bold text-lg flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center">{{ $enrollment->student->name }}</span>
              </div>
              <div class="flex items-baseline gap-2">
                <span class="khmer-moul text-sm text-blue-900 w-24 whitespace-nowrap">វគ្គសិក្សា៖</span>
                <span
                  class="khmer-siemreap font-bold flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center">{{ $enrollment->courseOffering->subject->name }}</span>
              </div>
              <div class="flex items-baseline gap-2">
                <span class="khmer-moul text-sm text-blue-900 w-24 whitespace-nowrap">និទ្ទេសៈ</span>
                <span
                  class="khmer-siemreap font-bold flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center">{{ $enrollment->letter_grade }}
                  ({{ $enrollment->manual_sum }} ពិន្ទុ)</span>
              </div>
              <div class="flex items-baseline gap-2">
                <span class="khmer-moul text-sm text-blue-900 w-24 whitespace-nowrap">អាសយដ្ឋាន៖</span>
                <span
                  class="khmer-siemreap flex-1 border-b border-dotted border-gray-600 pb-0.5 text-[12px] text-center">រាជធានីភ្នំពេញ,
                  ប្រទេសកម្ពុជា</span>
              </div>
              <div class="flex items-baseline gap-2">
                <span class="khmer-moul text-sm text-blue-900 w-24 whitespace-nowrap">សុពលភាព៖</span>
                <span class="khmer-siemreap flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center">
                  @if($enrollment->courseOffering->join_start)
                    ២០២៤ - ២០២៥
                  @else
                    គ្មាន
                  @endif
                </span>
              </div>
            </div>

            {{-- Right Column (English) --}}
            <div class="space-y-4">
              <div class="flex items-baseline gap-2">
                <span class="font-serif font-bold text-gray-700 w-24 whitespace-nowrap italic text-sm">Awarded to:</span>
                <span
                  class="font-serif font-bold text-lg flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center text-blue-900">{{ $enrollment->student->name }}</span>
              </div>
              <div class="flex items-baseline gap-2">
                <span class="font-serif font-bold text-gray-700 w-24 whitespace-nowrap italic text-sm">Course of:</span>
                <span
                  class="font-serif font-bold flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center">{{ $enrollment->courseOffering->subject->name }}</span>
              </div>
              <div class="flex items-baseline gap-2">
                <span class="font-serif font-bold text-gray-700 w-24 whitespace-nowrap italic text-sm">Grade:</span>
                <span
                  class="font-serif font-bold flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center text-red-600">{{ $enrollment->letter_grade }}</span>
              </div>
              <div class="flex items-baseline gap-2">
                <span class="font-serif font-bold text-gray-700 w-24 whitespace-nowrap italic text-sm">Location:</span>
                <span
                  class="font-serif flex-1 border-b border-dotted border-gray-600 pb-0.5 text-[12px] text-center">Phnom
                  Penh, Cambodia</span>
              </div>
              <div class="flex items-baseline gap-2">
                <span class="font-serif font-bold text-gray-700 w-24 whitespace-nowrap italic text-sm">Valid from:</span>
                <span class="font-serif flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center">
                  March 2024 to March 2025
                </span>
              </div>
            </div>
          </div>

          {{-- Message --}}
          <div class="text-center mt-6">
            <p class="khmer-siemreap text-[10px] text-gray-600 italic">សំគាល់:
              អ្នកកាន់វិញ្ញាបនបត្រត្រូវអនុវត្តតាមបទបញ្ជាផ្ទៃក្នុងរបស់មជ្ឈមណ្ឌលសិក្សាកម្ពុជា។</p>
          </div>

          {{-- Footer Section --}}
          <div class="grid grid-cols-4 items-end mt-10">
            {{-- QR Code --}}
            <div class="col-span-1">
              <div class="w-32 h-32 bg-white border border-gray-200 p-1">
                <img
                  src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ route('admin.enrollments.certificate', [$enrollment->student_id, $enrollment->course_offering_id]) }}"
                  alt="Verification QR" class="w-full h-full">
              </div>
            </div>

            {{-- Student Photo --}}
            <div class="col-span-1 flex justify-center">
              <div
                class="w-24 h-32 bg-gray-100 border-2 border-gray-300 relative overflow-hidden flex flex-col items-center justify-center p-1">
                @if($enrollment->student->profile_photo_url)
                  <img src="{{ $enrollment->student->profile_photo_url }}" alt="Student Photo"
                    class="w-full h-full object-cover">
                @else
                  <div class="text-center">
                    <i class="fa-solid fa-user text-gray-300 text-4xl"></i>
                    <p class="text-[8px] text-gray-400 mt-1 uppercase">Photo 4x6</p>
                  </div>
                @endif
              </div>
            </div>

            {{-- Signature & Stamp --}}
            <div class="col-span-2 relative text-right pr-6">
              <div class="khmer-siemreap text-[12px] mb-2">
                ធ្វើនៅរាជធានីភ្នំពេញ, ថ្ងៃទី {{ now()->format('d') }} ខែ {{ now()->format('m') }} ឆ្នាំ ២០២៥
              </div>
              <div class="khmer-siemreap font-bold mb-16">សាកលវិទ្យាធិការ (Director)</div>

              {{-- Mockup Stamp --}}
              <div class="absolute right-10 bottom-4 w-32 h-32 opacity-80 pointer-events-none">
                <div
                  class="w-full h-full rounded-full border-4 border-red-600 flex items-center justify-center text-red-600 font-bold text-center p-2 rotate-[-15deg] border-double">
                  <div class="text-[10px] leading-tight">
                    <span class="khmer-moul uppercase text-[8px]">សាលា SCMS</span><br>
                    <span class="border-y border-red-600 py-1 inline-block my-1 px-2 italic">CERTIFIED</span><br>
                    <span class="text-[8px] uppercase">Phnom Penh</span>
                  </div>
                </div>
              </div>

              <div class="khmer-moul text-lg text-blue-900 border-b border-gray-300 inline-block px-4">លោកនាយកសាលា</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    /* Khmer Font Assignments */
    .khmer-moul {
      font-family: 'Moul', cursive;
    }

    .khmer-siemreap {
      font-family: 'Siemreap', cursive;
    }

    .serif {
      font-family: 'Times New Roman', serif;
    }

    .certificate-container {
      width: 297mm;
      height: 210mm;
      background: #fff;
      position: relative;
      overflow: hidden;
    }

    /* Pattern Border - Mimicking the visual style in image */
    .pattern-border {
      padding: 15mm;
      height: 100%;
      background-color: #fff;
      position: relative;
    }

    .pattern-border::before {
      content: "";
      position: absolute;
      top: 5mm;
      left: 5mm;
      right: 5mm;
      bottom: 5mm;
      border: 8mm solid transparent;
      /* Use a traditional pattern if possible, here using a stylized SVG for border */
      border-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none" stroke="%23854d0e" stroke-width="20" stroke-dasharray="2,2"/></svg>') 10% repeat;
      pointer-events: none;
    }

    /* Fallback for the complex border from the image - using a stylized red-brown border */
    .pattern-border {
      border: 12px solid #8B4513;
      /* Brownish border */
      outline: 2px solid #8B4513;
      outline-offset: -12px;
    }

    .double-line-frame {
      border: 2px solid #800000;
      padding: 2px;
      height: 100%;
    }

    .inner-content {
      border: 1px solid #800000;
      height: 100%;
      background-image:
        radial-gradient(circle at 50% 50%, rgba(200, 200, 255, 0.05) 0%, transparent 80%);
    }

    @media print {
      @page {
        size: A4 landscape;
        margin: 0;
      }

      body {
        margin: 0;
        padding: 0;
      }

      .no-print {
        display: none !important;
      }

      .certificate-container {
        width: 100%;
        height: 100vh;
        box-shadow: none;
        margin: 0;
      }

      .pattern-border {
        print-color-adjust: exact;
        -webkit-print-color-adjust: exact;
      }
    }
  </style>
@endsection