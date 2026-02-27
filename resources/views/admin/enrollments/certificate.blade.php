@extends('layouts.admin')

@section('title', 'វិញ្ញាបនបត្រ - Certificate')

@section('content')
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

  <div class="certificate-container shadow-2xl mx-auto mb-10">
    <div class="inner-frame-content">
      <div class="inner-content relative">

        <div class="grid grid-cols-3 items-start mb-4">
          <div class="text-center flex flex-col items-center">
            <img src="{{ asset('assets/images/scms.png') }}" alt="School Logo" class="h-24 object-contain mb-1">
            <h4 class="khmer-moul text-[12px] text-blue-900">មជ្ឈមណ្ឌលសិក្សាវត្តដំណាក់</h4>
            <p class="khmer-siemreap text-[10px] text-red-800 font-bold">
              លេខ:......{{ str_pad($enrollment->id, 7, '0', STR_PAD_LEFT) }}......ម.ស.វ.ដ</p>
          </div>

          <div class="text-center">
            <h3 class="khmer-moul text-2xl text-blue-900 uppercase">ព្រះរាជាណាចក្រកម្ពុជា</h3>
            <h4 class="khmer-moul text-lg text-blue-900 mt-1">ជាតិ សាសនា ព្រះមហាក្សត្រ</h4>
          </div>

          <div class="text-right flex flex-col items-end">
            {{-- <div class="flex flex-col items-center">
              <span class="text-xl font-bold tracking-tighter text-blue-900 italic">SCMS</span>
              <span class="text-[8px] uppercase tracking-widest text-blue-800 font-bold">Kingdom of Excellence</span>
            </div> --}}
          </div>
        </div>

        <div class="text-center mb-4">
          <h1 class="khmer-moul text-4xl text-blue-900">វិញ្ញាបនបត្របញ្ជាក់ការសិក្សា</h1>
          <p class="text-xl font-bold text-gray-800 tracking-wider font-serif uppercase mt-1">Certificate of Achievement
          </p>
        </div>

        <div class="grid grid-cols-2 gap-10">
          <div class="space-y-1">
            <div class="flex items-baseline gap-2">
              <span class="khmer-moul text-sm text-blue-900 w-24 whitespace-nowrap">ទទួលបាន៖</span>
              <span
                class="font-serif font-bold text-lg flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center text-blue-900">{{ $enrollment->student->name }}</span>
            </div>
            <div class="flex items-baseline gap-2">
              <span class="khmer-moul text-sm text-blue-900 w-24 whitespace-nowrap">វគ្គសិក្សា៖</span>
              <span
                class="font-serif font-bold text-lg flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center text-blue-900">{{ $enrollment->courseOffering->subject->name }}</span>
            </div>
            <div class="flex items-baseline gap-2">
              <span class="khmer-moul text-sm text-blue-900 w-24 whitespace-nowrap">និទ្ទេសៈ</span>
              <span
                class="font-serif font-bold text-lg flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center text-blue-900">{{ $enrollment->letter_grade }}
                ({{ $enrollment->manual_sum }} ពិន្ទុ)</span>
            </div>
            <div class="flex items-baseline gap-2">
              <span class="khmer-moul text-sm text-blue-900 w-24 whitespace-nowrap">អាសយដ្ឋាន៖</span>
              <span
                class="font-serif font-bold text-lg flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center text-blue-900">
                សៀមរាប, ប្រទេសកម្ពុជា
              </span>
            </div>
          </div>

          <div class="space-y-1">
            <div class="flex items-baseline gap-2">
              <span class="font-serif font-bold text-gray-700 w-24 whitespace-nowrap italic text-sm">Awarded to:</span>
              <span
                class="font-serif font-bold text-lg flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center text-blue-900">{{ $enrollment->student->name }}</span>
            </div>
            <div class="flex items-baseline gap-2">
              <span class="font-serif font-bold text-gray-700 w-24 whitespace-nowrap italic text-sm">Course of:</span>
              <span
                class="font-serif font-bold text-lg flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center text-blue-900">{{ $enrollment->courseOffering->subject->name }}</span>
            </div>
            <div class="flex items-baseline gap-2">
              <span class="font-serif font-bold text-gray-700 w-24 whitespace-nowrap italic text-sm">Grade:</span>
              <span
                class="font-serif font-bold text-lg flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center text-blue-900">{{ $enrollment->letter_grade }}</span>
            </div>
            <div class="flex items-baseline gap-2">
              <span class="font-serif font-bold text-gray-700 w-24 whitespace-nowrap italic text-sm">Location:</span>
              <span
                class="font-serif font-bold text-lg flex-1 border-b border-dotted border-gray-600 pb-0.5 text-center text-blue-900">
                Siem Reap, Cambodia
              </span>
            </div>
          </div>
        </div>

        <div class="text-center mt-4">
          <p class="khmer-siemreap text-[10px] text-gray-600 italic">សំគាល់:
            អ្នកកាន់វិញ្ញាបនបត្រត្រូវអនុវត្តតាមបទបញ្ជាផ្ទៃក្នុងរបស់មជ្ឈមណ្ឌលសិក្សាវត្តដំណាក់។</p>
        </div>

        <div class="grid grid-cols-3 items-end mt-6">
          <div class="col-span-1">
            <div class="w-40 h-40 bg-white border border-gray-200 p-1">
              <img
                src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ route('admin.enrollments.certificate', [$enrollment->student_id, $enrollment->course_offering_id]) }}"
                alt="Verification QR" class="w-full h-full">
            </div>
          </div>

          <div class="col-span-1 flex justify-center">
            <div
              class="w-32 h-40 bg-gray-100 border border-gray-300 relative overflow-hidden flex flex-col items-center justify-center p-1">
              @if ($enrollment->student->avatar_url)
                <img src="{{ $enrollment->student->avatar_url }}" alt="Student Photo" class="w-full h-full object-cover">
              @else
                <div class="text-center">
                  <i class="fa-solid fa-user text-gray-300 text-4xl"></i>
                  <p class="text-[8px] text-gray-400 mt-1 uppercase">Photo 4x6</p>
                </div>
              @endif
            </div>
          </div>

          <div class="col-span-1 relative text-right pr-6">
            <div class="khmer-siemreap text-[12px] mb-2 text-black">
              ធ្វើនៅសៀមរាប, ថ្ងៃទី {{ now()->format('d') }} ខែ {{ now()->format('m') }} ឆ្នាំ {{ now()->format('Y') }}
            </div>
            <div class="khmer-siemreap font-bold mb-16 text-black">សាកលវិទ្យាធិការ (Director)</div>

            <div class="absolute right-12 bottom-4 w-32 h-32 opacity-90 pointer-events-none z-20">
              <img src="{{ asset('assets/images/stamp.png') }}" alt="Stamp" class="w-full h-full object-contain">
            </div>

            <div class="khmer-moul text-lg text-blue-900 border-b border-gray-300 inline-block px-4">
              លោកនាយកសាលា
            </div>

          </div>
        </div>
      </div>
    </div>

    <style>
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
        background-color: white;
        position: relative;
        background-image: url('{{ asset('assets/images/frame.png') }}');
        background-size: 100% 100%;
        background-repeat: no-repeat;
        padding: 30mm;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
      }

      .inner-frame-content {
        height: 100%;
        padding: 2px;
        display: flex;
        flex-direction: column;
      }

      .inner-content {
        height: 100%;
        padding: 10px 30px;
        background-image:
          radial-gradient(circle at 50% 50%, rgba(200, 200, 255, 0.03) 0%, transparent 80%);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }

      @media print {
        @page {
          size: A4 landscape;
          margin: 0;
        }

        body * {
          visibility: hidden;
        }

        .certificate-container,
        .certificate-container * {
          visibility: visible;
        }

        .certificate-container {
          position: absolute;
          left: 0;
          top: 0;
          width: 297mm;
          height: 210mm;
          margin: 0;
          padding: 30mm;
          box-shadow: none;
          print-color-adjust: exact;
          -webkit-print-color-adjust: exact;
          background-image: url('{{ asset('assets/images/frame.png') }}') !important;
          background-size: 100% 100% !important;
        }

        .certificate-container {
          content-visibility: visible;
        }

        .no-print {
          display: none !important;
        }
      }
    </style>
@endsection