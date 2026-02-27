<!DOCTYPE html>
<html lang="km">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Certificate - {{ $enrollment->student->name }}</title>
  <style>
    @page {
      margin: 0;
      size: A4 landscape;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Khmer OS', 'Siemreap', sans-serif;
      background: white;
    }

    .certificate-wrapper {
      width: 297mm;
      height: 210mm;
      position: relative;
      background-image: url('{{ public_path('assets/images/frame.png') }}');
      background-size: 100% 100%;
      background-repeat: no-repeat;
      padding: 35mm 30mm;
    }

    .pdf-table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
    }

    .khmer-moul {
      font-family: 'Moul', sans-serif;
    }

    .khmer-siemreap {
      font-family: 'Siemreap', sans-serif;
    }

    .text-blue-900 {
      color: #1e3a8a;
    }

    .text-red-800 {
      color: #991b1b;
    }

    .border-dotted {
      border-bottom: 1.5px dotted #4b5563;
    }

    .uppercase {
      text-transform: uppercase;
    }

    .text-center {
      text-align: center;
    }

    .text-right {
      text-align: right;
    }

    .font-bold {
      font-weight: bold;
    }

    @font-face {
      font-family: 'Moul';
      src: url('{{ public_path('assets/fonts/moul.ttf') }}') format('truetype');
      font-weight: normal;
      font-style: normal;
    }

    @font-face {
      font-family: 'Siemreap';
      src: url('{{ public_path('assets/fonts/siemreap.ttf') }}') format('truetype');
      font-weight: normal;
      font-style: normal;
    }
  </style>
</head>

<body>
  <div class="certificate-wrapper">
    <table class="pdf-table">
      <tr>
        <td width="33%" class="text-center">
          <img src="{{ public_path('assets/images/scms.png') }}" style="height: 80px; margin-bottom: 5px;">
          <div class="khmer-moul text-blue-900" style="font-size: 11px;">មជ្ឈមណ្ឌលសិក្សាវត្តដំណាក់</div>
          <div class="khmer-siemreap text-red-800 font-bold" style="font-size: 10px;">
            លេខ:......{{ str_pad($enrollment->id, 7, '0', STR_PAD_LEFT) }}......ម.ស.វ.ដ</div>
        </td>
        <td width="34%" class="text-center" style="vertical-align: top; padding-top: 10px;">
          <div class="khmer-moul text-blue-900 uppercase" style="font-size: 20px;">ព្រះរាជាណាចក្រកម្ពុជា</div>
          <div class="khmer-moul text-blue-900" style="font-size: 16px; margin-top: 5px;">ជាតិ សាសនា ព្រះមហាក្សត្រ</div>
        </td>
        <td width="33%"></td>
      </tr>
    </table>

    <div class="text-center" style="margin: 25px 0;">
      <div class="khmer-moul text-blue-900" style="font-size: 32px;">វិញ្ញាបនបត្របញ្ជាក់ការសិក្សា</div>
      <div
        style="font-size: 18px; font-weight: bold; text-transform: uppercase; color: #1e3a8a; font-family: 'Times New Roman', serif; margin-top: 5px;">
        Certificate of Achievement</div>
    </div>

    <table class="pdf-table" style="margin-top: 10px;">
      <tr>
        <td width="50%" style="padding-right: 20px; vertical-align: top;">
          <table class="pdf-table">
            <tr>
              <td width="90" class="khmer-moul text-blue-900" style="font-size: 13px; padding-bottom: 20px;">ទទួលបាន៖
              </td>
              <td class="text-center border-dotted text-blue-900 font-bold"
                style="font-size: 18px; padding-bottom: 5px;">{{ $enrollment->student->name }}</td>
            </tr>
            <tr>
              <td class="khmer-moul text-blue-900" style="font-size: 13px; padding-bottom: 20px; padding-top: 5px;">
                វគ្គសិក្សា៖</td>
              <td class="text-center border-dotted text-blue-900 font-bold"
                style="font-size: 18px; padding-bottom: 5px;">{{ $enrollment->courseOffering->subject->name }}</td>
            </tr>
            <tr>
              <td class="khmer-moul text-blue-900" style="font-size: 13px; padding-bottom: 20px; padding-top: 5px;">
                និទ្ទេសៈ</td>
              <td class="text-center border-dotted text-blue-900 font-bold"
                style="font-size: 18px; padding-bottom: 5px;">{{ $enrollment->letter_grade }}
                ({{ $enrollment->manual_sum }} ពិន្ទុ)</td>
            </tr>
            <tr>
              <td class="khmer-moul text-blue-900" style="font-size: 13px; padding-bottom: 20px; padding-top: 5px;">
                អាសយដ្ឋាន៖</td>
              <td class="text-center border-dotted text-blue-900 font-bold"
                style="font-size: 18px; padding-bottom: 5px;">សៀមរាប, ប្រទេសកម្ពុជា</td>
            </tr>
          </table>
        </td>
        <td width="50%" style="padding-left: 20px; vertical-align: top;">
          <table class="pdf-table">
            <tr>
              <td width="100"
                style="font-weight: bold; color: #1e3a8a; font-size: 13px; font-family: 'Times New Roman', serif; padding-bottom: 20px;">
                Awarded to:</td>
              <td class="text-center border-dotted text-blue-900 font-bold"
                style="font-size: 18px; padding-bottom: 5px; font-family: 'Times New Roman', serif;">
                {{ $enrollment->student->name }}
              </td>
            </tr>
            <tr>
              <td
                style="font-weight: bold; color: #1e3a8a; font-size: 13px; font-family: 'Times New Roman', serif; padding-bottom: 20px; padding-top: 5px;">
                Course of:</td>
              <td class="text-center border-dotted text-blue-900 font-bold"
                style="font-size: 18px; padding-bottom: 5px; font-family: 'Times New Roman', serif;">
                {{ $enrollment->courseOffering->subject->name }}
              </td>
            </tr>
            <tr>
              <td
                style="font-weight: bold; color: #1e3a8a; font-size: 13px; font-family: 'Times New Roman', serif; padding-bottom: 20px; padding-top: 5px;">
                Grade:</td>
              <td class="text-center border-dotted text-blue-900 font-bold"
                style="font-size: 18px; padding-bottom: 5px; font-family: 'Times New Roman', serif;">
                {{ $enrollment->letter_grade }}
              </td>
            </tr>
            <tr>
              <td
                style="font-weight: bold; color: #1e3a8a; font-size: 13px; font-family: 'Times New Roman', serif; padding-bottom: 20px; padding-top: 5px;">
                Location:</td>
              <td class="text-center border-dotted text-blue-900 font-bold"
                style="font-size: 18px; padding-bottom: 5px; font-family: 'Times New Roman', serif;">Siem Reap, Cambodia
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <div class="text-center khmer-siemreap" style="font-size: 10px; margin-top: 15px; color: #666; font-style: italic;">
      សំគាល់: អ្នកកាន់វិញ្ញាបនបត្រត្រូវអនុវត្តតាមបទបញ្ជាផ្ទៃក្នុងរបស់មជ្ឈមណ្ឌលសិក្សាវត្តដំណាក់។
    </div>

    <table class="pdf-table" style="margin-top: 25px;">
      <tr>
        <td width="30%">
          <div style="width: 120px; height: 120px; background: white; border: 1px solid #ddd; padding: 5px;">
            <img
              src="https://api.qrserver.com/v1/create-qr-code/?size=110x110&data={{ route('admin.enrollments.certificate', [$enrollment->student_id, $enrollment->course_offering_id]) }}"
              style="width: 100%;">
          </div>
        </td>
        <td width="30%" class="text-center">
          <div
            style="width: 110px; height: 140px; border: 1px solid #ccc; background: #f9f9f9; padding: 2px; margin: 0 auto;">
            @php
              $avatarPath = $enrollment->student->avatar ? public_path('storage/' . $enrollment->student->avatar) : null;
            @endphp
            @if ($avatarPath && file_exists($avatarPath))
              <img src="{{ $avatarPath }}" style="width: 100%; height: 100%;">
            @elseif($enrollment->student->avatar_url)
              <img src="{{ $enrollment->student->avatar_url }}" style="width: 100%; height: 100%;">
            @else
              <div style="padding-top: 50px; color: #ccc; font-size: 10px;">Photo 4x6</div>
            @endif
          </div>
        </td>
        <td width="40%" class="text-right" style="vertical-align: top; padding-right: 15px; position: relative;">
          <div class="khmer-siemreap" style="font-size: 12px; margin-bottom: 5px;">
            ធ្វើនៅសៀមរាប, ថ្ងៃទី {{ now()->format('d') }} ខែ {{ now()->format('m') }} ឆ្នាំ {{ now()->format('Y') }}
          </div>
          <div class="khmer-siemreap font-bold" style="font-size: 14px; margin-bottom: 70px;">សាកលវិទ្យាធិការ (Director)
          </div>

          <div style="position: absolute; right: 50px; bottom: 15px; width: 110px; height: 110px; z-index: 20;">
            <img src="{{ public_path('assets/images/stamp.png') }}" style="width: 100%;">
          </div>

          <div class="khmer-moul text-blue-900"
            style="font-size: 18px; border-bottom: 1.5px solid #ccc; display: inline-block; padding: 0 10px;">
            លោកនាយកសាលា</div>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>