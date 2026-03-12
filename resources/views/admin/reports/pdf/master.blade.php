<html>

  <head>
    <style>
      @page {
        margin: 1cm;
      }

      * {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
      }

      body {
        font-family: 'Helvetica', sans-serif;
        color: #333;
        line-height: 1.1;
        margin: 0;
        padding: 0;
        font-size: 8pt;
        width: 100%;
        word-wrap: break-word;
      }

      .header {
        text-align: center;
        border-bottom: 2px solid #ef4444;
        padding-bottom: 8px;
        margin-bottom: 15px;
        width: 100%;
      }

      .logo {
        font-size: 18pt;
        font-weight: bold;
        color: #b91c1c;
      }

      .report-title {
        font-size: 12pt;
        font-weight: bold;
        margin-top: 3px;
        color: #1f2937;
      }

      .report-period {
        font-size: 8pt;
        color: #6b7280;
        margin-top: 2px;
      }

      .footer {
        position: fixed;
        bottom: -0.5cm;
        left: 0;
        right: 0;
        width: 100%;
        font-size: 7pt;
        text-align: center;
        color: #9ca3af;
        border-top: 1px solid #e5e7eb;
        padding-top: 3px;
      }

      table {
        width: 100% !important;
        border-collapse: collapse;
        margin-bottom: 15px;
        table-layout: auto;
      }

      th {
        background-color: #f3f4f6;
        color: #374151;
        padding: 5px;
        font-size: 7.5pt;
        border: 1px solid #d1d5db;
        text-transform: uppercase;
        font-weight: bold;
        text-align: left;
      }

      td {
        padding: 5px;
        border: 1px solid #d1d5db;
        font-size: 7.5pt;
        vertical-align: top;
      }

      .text-right {
        text-align: right;
      }

      .font-bold {
        font-weight: bold;
      }

      .page-break {
        page-break-after: always;
      }

      /* PDF Layout Helpers */
      .pdf-grid {
        width: 100%;
        margin-bottom: 10px;
        display: block;
      }

      .pdf-grid::after {
        content: "";
        clear: both;
        display: table;
      }

      .pdf-col-3 {
        width: 32%;
        float: left;
        margin-right: 2%;
      }

      .pdf-col-3:last-child {
        margin-right: 0;
      }

      .pdf-col-2 {
        width: 49%;
        float: left;
        margin-right: 2%;
      }

      .pdf-col-2:last-child {
        margin-right: 0;
      }

      .pdf-box {
        border: 1px solid #d1d5db;
        padding: 8px;
        border-radius: 5px;
        background-color: #ffffff;
      }

      .pdf-title {
        font-size: 7pt;
        color: #4b5563;
        margin-bottom: 1px;
        font-weight: bold;
      }

      .pdf-value {
        font-size: 12pt;
        font-weight: bold;
      }
    </style>
  </head>

  <body>
    <div class="header">
      <div class="logo">SCMS G2</div>
      <div class="report-title">{{ $title }}</div>
      <div class="report-period">Period: {{ request('start_date') }} to {{ request('end_date') }}</div>
    </div>

    @include($view)

    <div class="footer">
      {{ __('message.printed_by') }} {{ auth()->user()->name }} {{ __('message.on') }} {{ date('Y-m-d H:i:s') }} -
      {{ __('message.page_1_of_1') }}
    </div>
  </body>

</html>
