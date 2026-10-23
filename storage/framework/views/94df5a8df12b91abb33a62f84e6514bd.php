
<div id="customizerModal"
  class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
  <div class="bg-[#FAF7F2] rounded-3xl max-w-md w-full max-h-[90vh] overflow-y-auto p-6 sm:p-8 shadow-2xl border border-[#DED4C3] relative">
    <button onclick="closeCustomizer()"
      class="absolute top-4 right-4 p-1.5 rounded-full text-[#7B8B77] hover:bg-[#EAE2D3] transition">
      <i data-lucide="x" class="w-5 h-5"></i>
    </button>
    <div id="customizerContent">
      
    </div>
  </div>
</div>


<div id="cartDrawer" class="fixed inset-0 z-50 pointer-events-none">

  
  <div id="cartBackdrop"
    class="absolute inset-0 bg-black/50 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
  </div>

  
  <div id="cartPanel"
    class="absolute right-0 top-0 bottom-0 max-w-md w-full bg-[#FAF7F2] border-l border-[#DCD3C0] shadow-2xl
           flex flex-col transform translate-x-full transition-transform duration-300 pointer-events-auto">

    
    <div class="flex items-center justify-between px-6 py-5 border-b border-[#E3DACB] shrink-0">
      <div class="flex items-center gap-2">
        <i data-lucide="cup-soda" class="w-5 h-5 text-[#3C5735]"></i>
        <h3 class="font-serif text-lg text-[#1C251C] font-semibold">Your Matcha Tray</h3>
      </div>
      <button id="closeCartBtn"
        class="p-1.5 rounded-full text-[#778573] hover:bg-[#EAE2D3] transition">
        <i data-lucide="x" class="w-5 h-5"></i>
      </button>
    </div>

    
    <div id="cartItemsContainer" class="flex-1 overflow-y-auto px-6 py-4 space-y-1">
      
    </div>

    
    <div class="px-6 pb-6 pt-4 border-t border-[#E3DACB] space-y-4 shrink-0 bg-[#FAF7F2]">

      
      <div class="space-y-1 text-xs">
        <div class="flex justify-between text-[#687566]">
          <span>Subtotal</span>
          <span id="cartSubtotal" class="font-mono">Rp 0</span>
        </div>
        <div class="flex justify-between text-[#687566]">
          <span>Tax (PB1 10%)</span>
          <span id="cartTax" class="font-mono">Rp 0</span>
        </div>
        <div class="flex justify-between text-sm font-bold text-[#1C251C] pt-1.5 border-t border-[#E3DACB]">
          <span>Total Amount</span>
          <span id="cartTotal" class="font-mono text-[#2E4329]">Rp 0</span>
        </div>
      </div>

      
      <div class="space-y-2 text-xs">
        <input id="custNameInput" type="text"
          placeholder="Your Name / Table / Room *"
          class="w-full text-xs p-2.5 rounded-xl border border-[#C5BBA7] bg-white
                 focus:outline-none focus:ring-2 focus:ring-[#375231] transition" />
        <div class="grid grid-cols-2 gap-2">
          <input id="custPhoneInput" type="tel"
            placeholder="WhatsApp / Phone"
            class="w-full text-xs p-2.5 rounded-xl border border-[#C5BBA7] bg-white
                   focus:outline-none focus:ring-2 focus:ring-[#375231] transition" />
          <select id="custDineOption"
            class="w-full text-xs p-2.5 rounded-xl border border-[#C5BBA7] bg-white
                   focus:outline-none focus:ring-2 focus:ring-[#375231] transition">
            <option value="Dine-In (Ceramic Chawan)">Dine-In (Chawan)</option>
            <option value="Takeaway Atelier Cup">Takeaway Cup</option>
          </select>
        </div>
        
        <textarea id="custNotesInput" rows="2"
          placeholder="Special request? (e.g. extra hot, less ice, no straw…)"
          class="w-full text-xs p-2.5 rounded-xl border border-[#C5BBA7] bg-white resize-none
                 focus:outline-none focus:ring-2 focus:ring-[#375231] transition"></textarea>
      </div>

      
      <button id="proceedOrderBtn"
        class="w-full py-3.5 rounded-full bg-[#273B24] text-[#FAF7F2] text-sm font-semibold
               hover:bg-[#344F30] transition shadow-md flex items-center justify-center gap-2
               disabled:opacity-60 disabled:cursor-not-allowed">
        <i data-lucide="check-circle-2" class="w-4 h-4"></i>
        <span id="proceedOrderLabel">Confirm Order</span>
      </button>

    </div>
  </div>
</div>


<div id="receiptModal"
  class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
  <div class="bg-[#FAF7F2] rounded-3xl max-w-sm w-full max-h-[90vh] overflow-y-auto p-6 shadow-2xl border border-[#DED4C3] text-center">

    <div class="w-12 h-12 rounded-full bg-[#E3EFE0] text-[#2F4928] flex items-center justify-center mx-auto mb-3">
      <i data-lucide="receipt-text" class="w-6 h-6"></i>
    </div>

    <span class="text-[10px] font-mono text-[#6A7866] tracking-widest uppercase block">Chaeri-e Order Receipt</span>
    <h3 class="font-serif text-2xl font-bold text-[#1F2C1D] mt-1" id="receiptOrderId">#ORD-001</h3>

    <div class="mt-4 p-4 rounded-2xl bg-white border border-[#DDD3C1] text-left text-xs space-y-2">
      <div class="flex justify-between text-[#6F7D6D]">
        <span>Customer</span>
        <span id="receiptCustomerName" class="font-semibold text-[#1F2A1E]">—</span>
      </div>
      <div class="flex justify-between text-[#6F7D6D]">
        <span>Dine Option</span>
        <span id="receiptDineOption" class="font-semibold text-[#1F2A1E]">—</span>
      </div>
      <div class="flex justify-between text-[#6F7D6D]">
        <span>Status</span>
        <span class="font-semibold text-[#2D5A2B] bg-[#E3F2E1] px-2 py-0.5 rounded-full text-[10px]">PAID</span>
      </div>
    </div>

    
    <div class="mt-3 p-4 rounded-2xl bg-white border border-[#DDD3C1] text-left text-xs space-y-2">
      <p class="text-[10px] font-mono text-[#6A7866] uppercase tracking-widest mb-1">Items Ordered</p>
      <div id="receiptItemsList" class="space-y-1.5">
        
      </div>
      <div class="pt-2 border-t border-dashed border-[#DDD3C1] flex justify-between font-bold text-sm text-[#1C271A]">
        <span>Total Paid</span>
        <span id="receiptTotalAmount" class="font-mono text-[#2B4326]">Rp 0</span>
      </div>
    </div>

    
    <div id="receiptNotesBlock" class="hidden mt-3 p-3 rounded-2xl bg-[#F4F0E8] border border-[#DDD3C1] text-left text-xs">
      <p class="text-[10px] font-mono text-[#6A7866] uppercase tracking-widest mb-1">Special Request</p>
      <p id="receiptNotes" class="text-[#4F5D4D] italic leading-relaxed"></p>
    </div>

    
    <div class="mt-3 p-3 rounded-2xl bg-[#F0EBE1] border border-[#DDD3C1] inline-block">
      <img id="receiptQrImage"
        src="https://api.qrserver.com/v1/create-qr-code/?size=140x140&data=CHAERI-E-ORDER"
        alt="Order QR Code"
        class="w-28 h-28 mx-auto mix-blend-multiply" />
      <p class="text-[10px] text-[#697866] mt-2 font-mono">Order reference code</p>
    </div>

    <div class="mt-5">
      <button onclick="closeReceiptModal()"
        class="w-full py-2.5 rounded-full bg-[#273B24] text-white text-xs font-medium hover:bg-[#365032] transition">
        Done
      </button>
    </div>

  </div>
</div>
<?php /**PATH C:\Users\joyce\OneDrive\Documents\chaeri-e\resources\views/matcha/partials/modals.blade.php ENDPATH**/ ?>