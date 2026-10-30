@extends('layouts.app')

@section('title', 'Chaeri-e Matcha | Artisanal Japanese Tea Atelier')

@section('content')
  <!-- HERO SECTION -->
  <header class="relative overflow-hidden pt-12 pb-24 md:py-24 border-b border-[#E7DFD1]">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-12 gap-12 items-center">
      <div class="md:col-span-6 space-y-6">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#E5EDDF] text-[#2C4A25] text-xs font-medium tracking-wide">
          <span class="w-2 h-2 rounded-full bg-[#4E6E45] animate-pulse"></span>
          Handcrafted Daily in Small Batches
        </div>

        <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-[#182318] leading-[1.15] font-normal">
          Honoring the Spirit of <span class="italic font-serif text-[#395632]">Ichigo Ichie</span> Through Pure Emerald Tea.
        </h1>

        <p class="text-base sm:text-lg text-[#556353] max-w-xl font-light leading-relaxed">
          From shaded camellia leaves in Uji to your handcrafted chawan bowl. Discover traditional ceremonial Usucha, velvet cloud lattes, and artisanal infusions made fresh to order.
        </p>

        <div class="pt-2 flex flex-wrap gap-4 items-center">
          <a href="#menu" class="px-7 py-3.5 rounded-full bg-[#273B24] text-[#FAF7F2] font-medium text-sm hover:bg-[#365232] transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
            Explore Handcrafted Menu
          </a>
          <a href="#history" class="px-7 py-3.5 rounded-full bg-transparent border border-[#273B24] text-[#273B24] font-medium text-sm hover:bg-[#EAE3D3]/60 transition-all">
            Matcha Chronicle
          </a>
        </div>

        <div class="pt-6 grid grid-cols-3 gap-6 border-t border-[#E3DACB] text-center sm:text-left">
          <div>
            <p class="font-serif text-2xl font-bold text-[#1E2B1B]">100%</p>
            <p class="text-xs text-[#6F7C6D]">Uji Ceremonial Grade</p>
          </div>
          <div>
            <p class="font-serif text-2xl font-bold text-[#1E2B1B]">30 Days</p>
            <p class="text-xs text-[#6F7C6D]">Sub-Canopy Shaded</p>
          </div>
          <div>
            <p class="font-serif text-2xl font-bold text-[#1E2B1B]">0 Artificial</p>
            <p class="text-xs text-[#6F7C6D]">Colors or Preservatives</p>
          </div>
        </div>
      </div>

      <!-- Hero Visual -->
      <div class="md:col-span-6 relative">
        <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-[#FFFFFF] aspect-[4/5] max-h-[580px] w-full">
          <img 
            src="{{ asset('images/Usucha.jpeg') }}" 
            alt="Authentic Japanese Matcha Whisking Ceremony in Chawan" 
            class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700"
          />
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

          <div class="absolute bottom-6 left-6 right-6 p-5 rounded-2xl bg-[#FAF7F2]/90 backdrop-blur-md border border-white/50 text-[#1D251C]">
            <p class="text-[11px] font-mono tracking-widest text-[#5B6D56] uppercase">Whisked In Traditional Pottery</p>
            <h4 class="font-serif text-lg font-semibold">Chasen, Chashaku & Heavy Ceramic Chawan</h4>
            <p class="text-xs text-[#5E6D5C] mt-1">Froth aerated at precise 78°C spring water to yield rich umami and gentle sweetness.</p>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- STORE BACKGROUND SECTION -->
  <section id="about" class="py-20 bg-[#F4EFE6] border-b border-[#E5DDD0]">
    <div class="max-w-7xl mx-auto px-6">
      <div class="max-w-3xl mb-14">
        <span class="text-xs font-mono tracking-widest text-[#5B7153] uppercase font-semibold">Our Background & Philosophy</span>
        <h2 class="font-serif text-3xl sm:text-4xl text-[#1E2B1D] mt-2">Born from Silence, Grown Under Sunlight and Shading Screens</h2>
        <p class="text-sm sm:text-base text-[#596657] mt-4 leading-relaxed font-light">
          Chaeri-e was created to restore mindfulness to tea drinking. Our leaves originate in the misty hills of Uji, Kyoto—harvested only once a year during the spring flush. We honor the centuries-old method of stone-grinding, retaining the lively jade hue and abundant L-theanine.
        </p>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        <div class="p-8 rounded-2xl bg-[#FAF7F2] border border-[#E3DACB] shadow-sm hover:shadow-md transition">
          <div class="w-12 h-12 rounded-xl bg-[#E4ECE0] flex items-center justify-center text-[#375231] mb-6">
            <i data-lucide="sun-dim" class="w-6 h-6"></i>
          </div>
          <h3 class="font-serif text-xl font-semibold text-[#1C251C] mb-2">30-Day Canopy Shading</h3>
          <p class="text-sm text-[#5B6959] leading-relaxed font-light">
            Before harvesting, the tea bushes are shaded using tana reed screens. This boosts chlorophyll and L-theanine levels, naturally removing bitterness.
          </p>
        </div>

        <div class="p-8 rounded-2xl bg-[#FAF7F2] border border-[#E3DACB] shadow-sm hover:shadow-md transition">
          <div class="w-12 h-12 rounded-xl bg-[#E4ECE0] flex items-center justify-center text-[#375231] mb-6">
            <i data-lucide="disc" class="w-6 h-6"></i>
          </div>
          <h3 class="font-serif text-xl font-semibold text-[#1C251C] mb-2">Granite Stone Mill</h3>
          <p class="text-sm text-[#5B6959] leading-relaxed font-light">
            Rotating granite mills grind just 30–40 grams of tea leaf per hour. This ultra-slow method protects aromatic compounds from excessive frictional heat.
          </p>
        </div>

        <div class="p-8 rounded-2xl bg-[#FAF7F2] border border-[#E3DACB] shadow-sm hover:shadow-md transition">
          <div class="w-12 h-12 rounded-xl bg-[#E4ECE0] flex items-center justify-center text-[#375231] mb-6">
            <i data-lucide="sparkles" class="w-6 h-6"></i>
          </div>
          <h3 class="font-serif text-xl font-semibold text-[#1C251C] mb-2">Conscious Hospitality</h3>
          <p class="text-sm text-[#5B6959] leading-relaxed font-light">
            Our atelier embraces modern cafe ease with traditional respect: order ahead, customize your temperature and sweetness.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- MATCHA HISTORY SECTION -->
  <section id="history" class="py-24 bg-[#FAF7F2] border-b border-[#E7DFD1]">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-5 space-y-6">
          <div class="inline-flex items-center gap-2 text-xs font-mono tracking-widest text-[#536B4C] uppercase font-semibold">
            <i data-lucide="book-open" class="w-4 h-4"></i>
            The Journey of Green Gold
          </div>
          <h2 class="font-serif text-3xl sm:text-4xl text-[#1B261A] leading-tight">
            From Zen Monasteries to Global Mindfulness
          </h2>
          <p class="text-sm sm:text-base text-[#576455] leading-relaxed font-light">
            Matcha’s roots run deep through over nine centuries of history. Originating in China during the Tang and Song Dynasties as steamed and powdered tea cakes, it was introduced to Japan in 1191 by Zen monk Eisai.
          </p>
          <p class="text-sm sm:text-base text-[#576455] leading-relaxed font-light">
            Later refined in Kyoto by grand tea master Sen no Rikyū, matcha became the centerpiece of Chanoyu (The Way of Tea) embodying four guiding values: <strong>Harmony (Wa)</strong>, <strong>Respect (Kei)</strong>, <strong>Purity (Sei)</strong>, and <strong>Tranquility (Jaku)</strong>.
          </p>
          <div class="p-5 rounded-2xl bg-[#F0EAE0] border border-[#DDD4C5] text-xs text-[#4F5D4D] italic">
            "Tea is nothing other than this: heat water, make tea, and drink it properly." — Sen no Rikyū
          </div>
        </div>

        <div class="lg:col-span-7">
          <div class="relative rounded-3xl overflow-hidden shadow-xl border border-[#DED4C3] bg-[#EFE9DF] p-6 sm:p-8">
            <h3 class="font-serif text-xl font-semibold text-[#1F2B1E] mb-6 flex items-center justify-between">
              Chronicle of Matcha
              <span class="text-xs font-mono text-[#72826E] font-normal">960 AD – PRESENT</span>
            </h3>

            <div class="space-y-6 relative border-l-2 border-[#CBD6C6] ml-3 pl-6">
              <div class="relative">
                <div class="absolute -left-[31px] top-1 w-3.5 h-3.5 rounded-full bg-[#3B5435] border-2 border-white"></div>
                <span class="text-xs font-mono font-semibold text-[#44603E]">960 – 1279 CE</span>
                <h4 class="font-serif text-base font-semibold text-[#1F2B1E] mt-0.5">Song Dynasty & Whipped Powdered Tea</h4>
                <p class="text-xs text-[#5D6B5B] mt-1">Leaves were steamed, dried, and ground into fine jade powder, whipped with hot water in dark ceramic bowls.</p>
              </div>

              <div class="relative">
                <div class="absolute -left-[31px] top-1 w-3.5 h-3.5 rounded-full bg-[#3B5435] border-2 border-white"></div>
                <span class="text-xs font-mono font-semibold text-[#44603E]">1191 CE</span>
                <h4 class="font-serif text-base font-semibold text-[#1F2B1E] mt-0.5">Eisai Brings Seeds to Kyoto</h4>
                <p class="text-xs text-[#5D6B5B] mt-1">Zen monk Eisai returned to Japan with Rinzai Zen practices and tea seeds, planting them in Uji where fertile soil and misty mornings made optimal green tea.</p>
              </div>

              <div class="relative">
                <div class="absolute -left-[31px] top-1 w-3.5 h-3.5 rounded-full bg-[#3B5435] border-2 border-white"></div>
                <span class="text-xs font-mono font-semibold text-[#44603E]">16th Century</span>
                <h4 class="font-serif text-base font-semibold text-[#1F2B1E] mt-0.5">Sen no Rikyū & Wabi-cha</h4>
                <p class="text-xs text-[#5D6B5B] mt-1">Eliminating ostentation, Rikyū embraced natural pottery, bamboo tools, and modest rustic tea huts that placed focus purely on human connection.</p>
              </div>

              <div class="relative">
                <div class="absolute -left-[31px] top-1 w-3.5 h-3.5 rounded-full bg-[#3B5435] border-2 border-white"></div>
                <span class="text-xs font-mono font-semibold text-[#44603E]">Modern Day</span>
                <h4 class="font-serif text-base font-semibold text-[#1F2B1E] mt-0.5">The Global Artisanal Atelier</h4>
                <p class="text-xs text-[#5D6B5B] mt-1">Now prized worldwide for high antioxidant profiles and focused mental calmness, matcha thrives in both traditional ceremonies and creative pairings.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MENU SECTION (DYNAMICALLY RENDERED FROM CONTROLLER) -->
  <section id="menu" class="py-24 bg-[#F5F0E8] border-b border-[#E5DDD0]">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center max-w-2xl mx-auto mb-16">
        <span class="text-xs font-mono tracking-widest text-[#506A48] uppercase font-semibold">The Four Signatures</span>
        <h2 class="font-serif text-3xl sm:text-5xl text-[#1B261A] mt-2">Crafted with Single-Origin Precision</h2>
        <p class="text-sm sm:text-base text-[#5A6858] mt-3 font-light">
          Each drink is prepared to order using authentic bamboo whisks and organic Japanese botanicals. Click any drink to customize and add to your bag.
        </p>
      </div>

      @foreach($menuItems as $key => $item)
        <div id="item-{{ $item['id'] }}" class="mb-16 bg-[#FAF7F2] rounded-3xl border border-[#DFD6C6] overflow-hidden shadow-sm hover:shadow-md transition">
          <div class="grid lg:grid-cols-12 items-stretch">
            <div class="lg:col-span-5 relative min-h-[300px] lg:min-h-[420px]">
              <img 
                src="{{ asset($item['image']) }}" 
                alt="{{ $item['name'] }}" 
                class="w-full h-full object-cover"
              />
              <div class="absolute top-4 left-4 bg-[#233320] text-[#EAF0E7] text-xs px-3 py-1 rounded-full font-mono">
                {{ $item['badge'] }}
              </div>
            </div>
            <div class="lg:col-span-7 p-8 sm:p-12 flex flex-col justify-between space-y-6">
              <div>
                <div class="flex items-center justify-between flex-wrap gap-2">
                  <h3 class="font-serif text-2xl sm:text-3xl text-[#1E2B1D] font-medium">{{ $item['name'] }}</h3>
                  <span class="font-serif text-2xl text-[#2F442A] font-bold">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                </div>
                <p class="text-xs font-mono text-[#6A7866] mt-1">{{ $item['subtitle'] }}</p>

                <p class="text-sm sm:text-base text-[#536051] mt-4 font-light leading-relaxed">
                  {{ $item['description'] }}
                </p>

                <!-- Flavor tags -->
                <div class="mt-6 flex flex-wrap gap-2">
                  @foreach($item['tags'] as $tag)
                    <span class="text-xs px-3 py-1 rounded-full bg-[#EAE2D3] text-[#334230]">{{ $tag }}</span>
                  @endforeach
                </div>
              </div>

              <div class="pt-6 border-t border-[#E7DFD1] flex flex-wrap items-center justify-between gap-4">
                <div class="text-xs text-[#6B7868]">
                  <span>Serving Size: {{ $item['serving'] }}</span> • <span>Prep: {{ $item['prep'] }}</span>
                </div>
                <button 
                  onclick="openCustomizer('{{ $item['id'] }}')" 
                  class="px-6 py-2.5 rounded-full bg-[#273B24] text-[#FAF7F2] text-sm font-medium hover:bg-[#385334] transition flex items-center gap-2">
                  <i data-lucide="plus" class="w-4 h-4"></i> Add {{ explode(' ', $item['name'])[0] }} to Order
                </button>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  <!-- THE WHISKING ART SECTION -->
  <section id="ritual" class="py-20 bg-[#FAF7F2] border-b border-[#E7DFD1]">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center max-w-2xl mx-auto mb-14">
        <span class="text-xs font-mono tracking-widest text-[#56724F] uppercase font-semibold">The Preparation Way</span>
        <h2 class="font-serif text-3xl sm:text-4xl text-[#1E2B1E] mt-2">How We Whisk Your Bowl</h2>
      </div>

      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="p-6 rounded-2xl bg-[#F5EFE4] border border-[#DDD3C1]">
          <span class="font-mono text-2xl text-[#6D8565] font-semibold block mb-2">01</span>
          <h4 class="font-serif text-lg font-semibold text-[#1C251C]">Fine Sifting</h4>
          <p class="text-xs text-[#5D6B5C] mt-2 leading-relaxed">
            Fresh matcha is pressed through an ultra-fine stainless sieve to aerate the powder and prevent clumping.
          </p>
        </div>

        <div class="p-6 rounded-2xl bg-[#F5EFE4] border border-[#DDD3C1]">
          <span class="font-mono text-2xl text-[#6D8565] font-semibold block mb-2">02</span>
          <h4 class="font-serif text-lg font-semibold text-[#1C251C]">Spring Water at 78°C</h4>
          <p class="text-xs text-[#5D6B5C] mt-2 leading-relaxed">
            Boiling water scorches delicate amino acids. We maintain natural spring water at exactly 78°C to retain sweet umami.
          </p>
        </div>

        <div class="p-6 rounded-2xl bg-[#F5EFE4] border border-[#DDD3C1]">
          <span class="font-mono text-2xl text-[#6D8565] font-semibold block mb-2">03</span>
          <h4 class="font-serif text-lg font-semibold text-[#1C251C]">The 'W' Whisk</h4>
          <p class="text-xs text-[#5D6B5C] mt-2 leading-relaxed">
            Rapid wrist motion in a "W" pattern using a 100-tine bamboo chasen suspended right above the bowl base.
          </p>
        </div>

        <div class="p-6 rounded-2xl bg-[#F5EFE4] border border-[#DDD3C1]">
          <span class="font-mono text-2xl text-[#6D8565] font-semibold block mb-2">04</span>
          <h4 class="font-serif text-lg font-semibold text-[#1C251C]">Crema Polishing</h4>
          <p class="text-xs text-[#5D6B5C] mt-2 leading-relaxed">
            A slow surface circle breaks large air bubbles, creating a dense, velvet micro-foam head before serving.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- WEBSITE INQUIRY SECTION (Before Footer) -->
  @include('matcha.partials.inquiry_section')

@endsection