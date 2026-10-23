<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Chaeri-e Matcha | Artisanal Japanese Tea Atelier')</title>

  <!-- Google Fonts & Tailwind CDN -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Shippori+Mincho:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- Custom Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  @stack('styles')
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-[#FAF7F2] text-[#242A24] antialiased selection:bg-[#4E6E45] selection:text-white">

  <!-- TOP BANNER -->
  <div class="bg-[#1C251C] text-[#E8EDDF] text-xs py-2 px-4 text-center tracking-wider font-light">
    <span>First Harvest Single-Origin Uji Tencha • Ceremonial Stone Ground</span>
  </div>

  <!-- NAVIGATION -->
  <nav class="sticky top-0 z-40 bg-[#FAF7F2]/90 backdrop-blur-md border-b border-[#E3DCCE] transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

      <!-- Logo -->
      <a href="{{ route('home') }}" class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-[#273B24] flex items-center justify-center text-[#EBF2E8] font-serif text-lg shadow-sm">
          木
        </div>
        <div>
          <span class="font-serif text-2xl tracking-wider text-[#1C251C] font-semibold block leading-none">Chaeri-e</span>
          <span class="text-[10px] tracking-[0.25em] text-[#6A7865] uppercase font-mono">Ceremonial Matcha Atelier</span>
        </div>
      </a>

      <!-- Desktop nav links -->
      <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-[#465344]">
        <a href="#about"   class="nav-link hover:text-[#273B24] transition-colors" data-section="about">Our Roots</a>
        <a href="#history" class="nav-link hover:text-[#273B24] transition-colors" data-section="history">Matcha History</a>
        <a href="#menu"    class="nav-link hover:text-[#273B24] transition-colors" data-section="menu">The Offerings</a>
        <a href="#ritual"  class="nav-link hover:text-[#273B24] transition-colors" data-section="ritual">The Whisking Art</a>
      </div>

      <!-- Right side actions -->
      <div class="flex items-center gap-3">
        <!-- Cart button -->
        <button id="openCartBtn" class="relative p-2.5 rounded-full bg-[#273B24] text-[#FAF7F2] hover:bg-[#344D30] transition shadow-md flex items-center justify-center">
          <i data-lucide="shopping-bag" class="w-5 h-5"></i>
          <span id="cartCountBadge" class="cart-badge absolute -top-1.5 -right-1.5 w-5 h-5 rounded-full bg-[#9E4733] text-white text-[11px] font-bold flex items-center justify-center border-2 border-[#FAF7F2] hidden">0</span>
        </button>
        <!-- Mobile hamburger -->
        <button id="mobileMenuBtn" class="md:hidden p-2.5 rounded-full text-[#273B24] hover:bg-[#EAE3D3] transition">
          <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
      </div>
    </div>

    <!-- Mobile menu (hidden by default) -->
    <div id="mobileMenu"
      class="md:hidden hidden border-t border-[#E3DCCE] bg-[#FAF7F2]/95 backdrop-blur-md px-6 py-4 space-y-1">
      <a href="#about"   class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium text-[#465344] hover:bg-[#EAE3D3] hover:text-[#273B24] transition-colors" data-section="about">
        <i data-lucide="leaf" class="w-4 h-4 text-[#5B7A52]"></i> Our Roots
      </a>
      <a href="#history" class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium text-[#465344] hover:bg-[#EAE3D3] hover:text-[#273B24] transition-colors" data-section="history">
        <i data-lucide="book-open" class="w-4 h-4 text-[#5B7A52]"></i> Matcha History
      </a>
      <a href="#menu"    class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium text-[#465344] hover:bg-[#EAE3D3] hover:text-[#273B24] transition-colors" data-section="menu">
        <i data-lucide="cup-soda" class="w-4 h-4 text-[#5B7A52]"></i> The Offerings
      </a>
      <a href="#ritual"  class="mobile-nav-link flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium text-[#465344] hover:bg-[#EAE3D3] hover:text-[#273B24] transition-colors" data-section="ritual">
        <i data-lucide="sparkles" class="w-4 h-4 text-[#5B7A52]"></i> The Whisking Art
      </a>
    </div>
  </nav>

  <!-- MAIN CONTENT -->
  <main>
    @yield('content')
  </main>

  <!-- FOOTER -->
  <footer class="bg-[#182318] text-[#E0E8DC] py-16">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-12 gap-10">
      <div class="md:col-span-5 space-y-4">
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-full bg-[#354B31] flex items-center justify-center text-[#EBF2E8] font-serif text-base">
            木
          </div>
          <span class="font-serif text-2xl text-white tracking-wider">Chaeri-e Matcha</span>
        </div>
        <p class="text-xs text-[#95A591] max-w-sm leading-relaxed font-light">
          Ceremonial grade Japanese green tea atelier. Respecting the slow crafts of stone-milling, hand-whisking, and genuine community hospitality.
        </p>
        <p class="text-[11px] text-[#788974] font-mono">
          Single-Origin Tencha • Shaded Kyoto Cultivars
        </p>
        <a href="https://www.instagram.com/chaeriematcha" target="_blank" rel="noopener noreferrer"
          class="inline-flex items-center gap-2 mt-2 text-xs text-[#95A591] hover:text-white transition-colors group">
          <span class="w-7 h-7 rounded-full bg-[#354B31] flex items-center justify-center group-hover:bg-[#4E6E45] transition-colors">
            <i data-lucide="instagram" class="w-3.5 h-3.5"></i>
          </span>
          @chaeriematcha
        </a>
      </div>

      <div class="md:col-span-3 space-y-2">
        <h5 class="text-xs font-mono tracking-widest text-[#B4C9AF] uppercase">The Atelier</h5>
        <p class="text-xs text-[#95A591]">Open Daily: 8:00 AM – 6:00 PM</p>
        <p class="text-xs text-[#95A591]">Tea Bar & Takeaway Service</p>
      </div>

      <div class="md:col-span-4 space-y-3">
        <h5 class="text-xs font-mono tracking-widest text-[#B4C9AF] uppercase">Need Counter Assistance?</h5>
        <p class="text-xs text-[#95A591]">Questions about origin or ceremonial tea masterclasses? Come find us at the counter.</p>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 pt-12 mt-12 border-t border-[#253423] text-center text-xs text-[#6F826B]">
      © {{ date('Y') }} Chaeri-e Artisanal Matcha Atelier. All rights reserved.
    </div>
  </footer>

  <!-- SCROLL TO TOP BUTTON -->
  <button id="scrollTopBtn"
    class="fixed bottom-6 right-6 z-40 w-10 h-10 rounded-full bg-[#273B24] text-[#FAF7F2]
           flex items-center justify-center shadow-lg opacity-0 pointer-events-none
           hover:bg-[#344D30] transition-all duration-300">
    <i data-lucide="arrow-up" class="w-4 h-4"></i>
  </button>

  <!-- MODALS & DRAWERS -->
  @include('matcha.partials.modals')

  <!-- Toast Notification -->
  <div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 bg-[#1E2A1E] text-white text-xs px-4 py-2.5 rounded-full shadow-lg transition-all duration-300 opacity-0 pointer-events-none z-50">
    Notification message
  </div>

  <!-- Application Script -->
  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>
</html>
