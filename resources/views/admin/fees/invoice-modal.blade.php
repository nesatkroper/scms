{{-- <div x-data="invoiceModal()" x-show="invoiceOpen" style="display:none;" class="fixed inset-0 z-50 overflow-y-auto"> --}}
<div x-show="invoiceOpen" x-cloak style="display:none;" class="fixed inset-0 z-50 overflow-y-auto">
  <div class="fixed inset-0 bg-black bg-opacity-70" @click="closeInvoiceModal()"></div>

  <div class="flex justify-center items-center min-h-screen p-4 print:hidden">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-2xl w-full p-8 relative">

      <!-- HEADER -->
      <div class="text-center border-b pb-4 mb-6">
        <img src="{{ asset('assets/images/cambodia.png') }}" class="mx-auto h-20 mb-2">

        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">INVOICE</h1>
        <p class="text-gray-500 dark:text-gray-300 text-sm">Official Payment Receipt</p>
      </div>

      <!-- SCHOOL INFO -->
      <div class="mb-6">
        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">G2 SCMS</p>
        <p class="text-sm text-gray-600 dark:text-gray-400">Siem Reap, Cambodia</p>
        <p class="text-sm text-gray-600 dark:text-gray-400">Phone: 0xx xxx xxx</p>
        <p class="text-sm text-gray-600 dark:text-gray-400">Email: school@example.com</p>
      </div>

      <!-- STUDENT + INVOICE INFO -->
      <div class="grid grid-cols-2 gap-4 mb-6 p-4 border rounded-lg bg-gray-50 dark:bg-gray-700">

        <div>
          <p class="text-xs text-gray-500 dark:text-gray-300 uppercase">Student</p>
          <p class="text-lg font-bold" x-text="invoice.student_name"></p>

          <p class="text-xs mt-3 text-gray-500 dark:text-gray-300 uppercase">Fee Type</p>
          <p class="font-semibold text-indigo-600" x-text="invoice.fee_type"></p>
        </div>

        <div>
          <p class="text-xs text-gray-500 dark:text-gray-300 uppercase">Invoice Date</p>
          <p class="font-semibold" x-text="invoice.payment_date"></p>

          <p class="text-xs mt-3 text-gray-500 dark:text-gray-300 uppercase">Transaction ID</p>
          <p class="font-mono text-sm font-semibold" x-text="invoice.transaction_id"></p>
        </div>

      </div>

      <!-- PAYMENT TABLE -->
      <table class="w-full text-sm mb-6 border-collapse">
        <thead>
          <tr class="bg-gray-100 dark:bg-gray-700">
            <th class="p-3 border dark:border-gray-600 text-left">Description</th>
            <th class="p-3 border dark:border-gray-600 w-32 text-right">Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="p-3 border dark:border-gray-700 font-medium" x-text="invoice.fee_type"></td>
            <td class="p-3 border dark:border-gray-700 text-right font-bold text-green-600 dark:text-green-300"
              x-text="'$' + parseFloat(invoice.amount).toFixed(2)">
            </td>
          </tr>
        </tbody>

        <tfoot>
          <tr class="bg-gray-100 dark:bg-gray-700">
            <td class="p-3 border dark:border-gray-600 text-right font-bold">Total</td>
            <td class="p-3 border dark:border-gray-600 text-right font-bold text-green-700 dark:text-green-300"
              x-text="'$' + parseFloat(invoice.amount).toFixed(2)">
            </td>
          </tr>
        </tfoot>
      </table>

      <!-- FOOTER -->
      <div class="text-center text-xs text-gray-500 border-t pt-4">
        <p>Thank you for your payment!</p>
        <p>This is a computer-generated invoice and does not require a signature.</p>
      </div>

      <!-- BUTTONS -->
      <div class="mt-6 flex justify-end gap-3 print:hidden">
        <button @click="closeInvoiceModal()" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg">
          Close
        </button>

        <button onclick="window.print()" class="px-4 py-2 bg-green-600 text-white rounded-lg">
          Print Invoice
        </button>
      </div>

    </div>
  </div>

  <!-- PRINT VERSION (A4 with 2 x A5 invoices) -->
  <div class="hidden print:grid print-duplicate-wrapper">

    <template x-for="n in 2">
      <div class="invoice-copy">

        <div class="text-center border-b pb-2 mb-4">
          <img src="{{ asset('assets/images/cambodia.png') }}" class="mx-auto h-16">
          <h1 class="text-xl font-bold">INVOICE</h1>
        </div>

        <p><strong>Student:</strong> <span x-text="invoice.student_name"></span></p>
        <p><strong>Fee Type:</strong> <span x-text="invoice.fee_type"></span></p>
        <p><strong>Date:</strong> <span x-text="invoice.payment_date"></span></p>
        <p><strong>Transaction ID:</strong> <span x-text="invoice.transaction_id"></span></p>

        <table class="w-full text-sm mt-3 border">
          <tr>
            <td class="border p-2">Description</td>
            <td class="border p-2 text-right" x-text="invoice.fee_type"></td>
          </tr>
          <tr>
            <td class="border p-2 font-bold">Amount</td>
            <td class="border p-2 text-right font-bold" x-text="'$' + parseFloat(invoice.amount).toFixed(2)"></td>
          </tr>
        </table>

        <!-- SIGNATURE AREA -->
        <div class="signature-area">
          <div class="signature-box">
            <div class="signature-line">Student Signature</div>
          </div>
          <div class="signature-box">
            <div class="signature-line">Staff Signature</div>
          </div>
        </div>

      </div>
    </template>

  </div>

</div>

<style>
  @media print {
    body {
      margin: 0;
      padding: 0;
    }

    .print-duplicate-wrapper {
      grid-template-rows: 1fr 1fr;
      padding: 20px;
      gap: 20px;
    }

    .invoice-copy {
      border: 1px solid #444;
      padding: 20px;
      page-break-inside: avoid;
    }

    .signature-area {
      margin-top: 40px;
      display: flex;
      justify-content: space-between;
    }

    .signature-box {
      width: 45%;
      text-align: center;
    }

    .signature-line {
      border-top: 1px solid #000;
      padding-top: 5px;
      margin-top: 60px;
    }
  }
</style>

<script>
  document.addEventListener("alpine:init", () => {
    Alpine.data("invoiceModal", () => ({

      invoiceOpen: false,

      invoice: {
        student_name: "",
        fee_type: "",
        amount: "",
        payment_date: "",
        transaction_id: "",
      },

      formatDate(dateString) {
        if (!dateString) return "";
        const date = new Date(dateString);

        return date.toLocaleDateString("km-KH", {
          weekday: "long",
          day: "2-digit",
          month: "2-digit",
          year: "numeric",
        });
      },

      openInvoiceModal(fee, feeType, student) {
        this.invoice.student_name = student.name;
        this.invoice.fee_type = feeType.name;
        this.invoice.amount = fee.amount;
        this.invoice.payment_date = this.formatDate(fee.payment_date);
        this.invoice.transaction_id = fee.transaction_id ?? "N/A";

        this.invoiceOpen = true;
      },

      closeInvoiceModal() {
        this.invoiceOpen = false;
      }
    }));
  });
</script>
