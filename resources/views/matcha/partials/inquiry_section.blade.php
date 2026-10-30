  <!-- WEBSITE INQUIRY SECTION (Before Footer) -->
  <section id="website-inquiry" class="py-24 bg-[#F2EDE4] border-b border-[#E3DACB] relative overflow-hidden">
    <!-- Decorative subtle background accents -->
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[#E5DEC9]/40 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-[#4E6E45]/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
      <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-start">
        
        <!-- Left Column: Value Proposition & Contact Info -->
        <div class="lg:col-span-5 space-y-6">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#E5EDDF] text-[#2C4A25] text-xs font-medium tracking-wide">
            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#4E6E45]"></i>
            <span>Digital Atelier • Web Creation</span>
          </div>

          <h2 class="font-serif text-3xl sm:text-4xl text-[#182318] leading-tight font-normal">
            Want Us to Build a <span class="italic font-serif text-[#395632]">Website</span> for Your Business?
          </h2>

          <p class="text-sm sm:text-base text-[#556353] font-light leading-relaxed">
            Just like our artisanal tea ceremony, we craft digital experiences with meticulous care. Whether you run a cafe, boutique shop, studio, or service brand, let us build you an elegant, fast, and high-converting website.
          </p>

          <div class="space-y-4 pt-2">
            <div class="flex items-start gap-3.5">
              <div class="w-9 h-9 rounded-xl bg-[#E4ECE0] flex items-center justify-center text-[#375231] shrink-0 mt-0.5">
                <i data-lucide="layout" class="w-4 h-4"></i>
              </div>
              <div>
                <h4 class="font-medium text-sm text-[#1C251C]">Bespoke & Aesthetic Design</h4>
                <p class="text-xs text-[#6A7866] mt-0.5 leading-relaxed">Custom layouts tailored to your brand identity, optimized for all screen sizes.</p>
              </div>
            </div>

            <div class="flex items-start gap-3.5">
              <div class="w-9 h-9 rounded-xl bg-[#E4ECE0] flex items-center justify-center text-[#375231] shrink-0 mt-0.5">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
              </div>
              <div>
                <h4 class="font-medium text-sm text-[#1C251C]">Seamless WhatsApp & Ordering</h4>
                <p class="text-xs text-[#6A7866] mt-0.5 leading-relaxed">Direct lead capture, online menu/catalog, and 1-click WhatsApp customer ordering.</p>
              </div>
            </div>

            <div class="flex items-start gap-3.5">
              <div class="w-9 h-9 rounded-xl bg-[#E4ECE0] flex items-center justify-center text-[#375231] shrink-0 mt-0.5">
                <i data-lucide="zap" class="w-4 h-4"></i>
              </div>
              <div>
                <h4 class="font-medium text-sm text-[#1C251C]">Lightning Fast & SEO Ready</h4>
                <p class="text-xs text-[#6A7866] mt-0.5 leading-relaxed">Optimized performance that ranks on Google and turns visitors into loyal patrons.</p>
              </div>
            </div>
          </div>

          <!-- Quick WhatsApp direct reach -->
          <div class="pt-4 border-t border-[#E3DACB]">
            <p class="text-xs text-[#6A7866] mb-3">Prefer immediate conversation?</p>
            <a href="https://wa.me/6281234567890?text=Hello%20Chaeri-e%20team,%20I%20would%20like%20to%20ask%20about%20making%20a%20website%20for%20my%20business." 
               target="_blank" 
               rel="noopener noreferrer"
               class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-full bg-[#2E7D32]/10 text-[#1B5E20] hover:bg-[#2E7D32]/20 font-medium text-xs transition border border-[#2E7D32]/20">
              <i data-lucide="phone-call" class="w-3.5 h-3.5"></i>
              <span>Direct WhatsApp Consultation</span>
            </a>
          </div>
        </div>

        <!-- Right Column: Interactive Inquiry Form -->
        <div class="lg:col-span-7">
          <div class="bg-[#FAF7F2] p-8 sm:p-10 rounded-3xl border border-[#E3DACB] shadow-lg shadow-black/5 relative">
            
            <div class="mb-6">
              <span class="text-[11px] font-mono tracking-widest text-[#5B6D56] uppercase font-semibold">Start A Consultation</span>
              <h3 class="font-serif text-2xl text-[#1E2B1D] font-medium mt-1">Tell Us About Your Project</h3>
              <p class="text-xs text-[#6A7866] mt-1">Fill in your contact information below and our team will get back to you with ideas and quote estimates.</p>
            </div>

            <!-- Flash Session Success Alert (Fallback) -->
            @if(session('inquiry_success'))
              <div class="mb-6 p-4 rounded-2xl bg-[#E8F3E5] border border-[#B9D8B3] text-[#22481D] flex items-start gap-3">
                <i data-lucide="check-circle-2" class="w-5 h-5 text-[#2E7D32] shrink-0 mt-0.5"></i>
                <div class="text-xs leading-relaxed">
                  <p class="font-semibold text-sm">Request Received Successfully!</p>
                  <p class="mt-0.5">{{ session('inquiry_success') }}</p>
                </div>
              </div>
            @endif

            <!-- Dynamic AJAX Status Banner -->
            <div id="inquiryAlertBox" class="hidden mb-6 p-4 rounded-2xl text-xs leading-relaxed transition-all"></div>

            <form id="websiteInquiryForm" action="{{ route('inquiries.store') }}" method="POST" class="space-y-5">
              @csrf

              <!-- Name & Business Name -->
              <div class="grid sm:grid-cols-2 gap-4">
                <div>
                  <label for="inq_name" class="block text-xs font-medium text-[#374435] mb-1.5">
                    Your Name <span class="text-[#A23A2A]">*</span>
                  </label>
                  <div class="relative">
                    <input 
                      type="text" 
                      id="inq_name" 
                      name="name" 
                      required 
                      placeholder="e.g. Maya Tanaka"
                      value="{{ old('name') }}"
                      class="w-full px-4 py-3 rounded-xl bg-white border border-[#DDD3C1] text-sm text-[#1C251C] placeholder-[#A4B0A1] focus:outline-none focus:ring-2 focus:ring-[#375231]/30 focus:border-[#375231] transition shadow-sm"
                    />
                  </div>
                </div>

                <div>
                  <label for="inq_business" class="block text-xs font-medium text-[#374435] mb-1.5">
                    Business / Brand Name
                  </label>
                  <div class="relative">
                    <input 
                      type="text" 
                      id="inq_business" 
                      name="business_name" 
                      placeholder="e.g. Kanso Artisan Bakery"
                      value="{{ old('business_name') }}"
                      class="w-full px-4 py-3 rounded-xl bg-white border border-[#DDD3C1] text-sm text-[#1C251C] placeholder-[#A4B0A1] focus:outline-none focus:ring-2 focus:ring-[#375231]/30 focus:border-[#375231] transition shadow-sm"
                    />
                  </div>
                </div>
              </div>

              <!-- Email -->
              <div>
                <label for="inq_email" class="block text-xs font-medium text-[#374435] mb-1.5">
                  Email Address <span class="text-[#A23A2A]">*</span>
                </label>
                <div class="relative">
                  <input 
                    type="email" 
                    id="inq_email" 
                    name="email" 
                    required 
                    placeholder="maya@example.com"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 rounded-xl bg-white border border-[#DDD3C1] text-sm text-[#1C251C] placeholder-[#A4B0A1] focus:outline-none focus:ring-2 focus:ring-[#375231]/30 focus:border-[#375231] transition shadow-sm"
                  />
                </div>
              </div>

              <!-- Phone & WhatsApp Number -->
              <div class="grid sm:grid-cols-2 gap-4">
                <div>
                  <label for="inq_phone" class="block text-xs font-medium text-[#374435] mb-1.5">
                    Phone Number
                  </label>
                  <div class="relative">
                    <input 
                      type="tel" 
                      id="inq_phone" 
                      name="phone" 
                      placeholder="e.g. 08123456789"
                      value="{{ old('phone') }}"
                      class="w-full px-4 py-3 rounded-xl bg-white border border-[#DDD3C1] text-sm text-[#1C251C] placeholder-[#A4B0A1] focus:outline-none focus:ring-2 focus:ring-[#375231]/30 focus:border-[#375231] transition shadow-sm"
                    />
                  </div>
                </div>

                <div>
                  <label for="inq_wa" class="block text-xs font-medium text-[#374435] mb-1.5 flex items-center justify-between">
                    <span>WhatsApp Number <span class="text-[#A23A2A]">*</span></span>
                    <span class="text-[10px] text-[#4E6E45] font-normal">Primary contact</span>
                  </label>
                  <div class="relative">
                    <input 
                      type="tel" 
                      id="inq_wa" 
                      name="wa_number" 
                      required 
                      placeholder="e.g. 08123456789 or +62..."
                      value="{{ old('wa_number') }}"
                      class="w-full px-4 py-3 rounded-xl bg-white border border-[#DDD3C1] text-sm text-[#1C251C] placeholder-[#A4B0A1] focus:outline-none focus:ring-2 focus:ring-[#375231]/30 focus:border-[#375231] transition shadow-sm"
                    />
                  </div>
                </div>
              </div>

              <!-- Project Notes / Description -->
              <div>
                <label for="inq_message" class="block text-xs font-medium text-[#374435] mb-1.5">
                  What kind of website are you looking for? <span class="text-xs text-[#7F8F7B] font-light">(Optional)</span>
                </label>
                <textarea 
                  id="inq_message" 
                  name="message" 
                  rows="3" 
                  placeholder="Tell us a little bit about your brand, preferred features (online menu, booking, online shop), or budget..."
                  class="w-full px-4 py-3 rounded-xl bg-white border border-[#DDD3C1] text-sm text-[#1C251C] placeholder-[#A4B0A1] focus:outline-none focus:ring-2 focus:ring-[#375231]/30 focus:border-[#375231] transition shadow-sm resize-none">{{ old('message') }}</textarea>
              </div>

              <!-- Submit button -->
              <div class="pt-2">
                <button 
                  type="submit" 
                  id="inquirySubmitBtn"
                  class="w-full py-3.5 px-6 rounded-full bg-[#273B24] text-[#FAF7F2] font-medium text-sm hover:bg-[#365232] transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 group disabled:opacity-50 disabled:cursor-not-allowed">
                  <span id="inquiryBtnText">Submit Website Consultation Request</span>
                  <i data-lucide="send" id="inquiryBtnIcon" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform"></i>
                  <span id="inquiryBtnSpinner" class="hidden">
                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                  </span>
                </button>
              </div>

              <div class="flex items-center justify-center gap-2 text-[11px] text-[#788974] pt-1">
                <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                <span>Your information is strictly confidential. No spam, ever.</span>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </section>

