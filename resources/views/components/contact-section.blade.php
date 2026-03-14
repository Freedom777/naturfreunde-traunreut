@props(['success' => false])

<section class="py-24 px-10 bg-white" id="kontakt">
  <div class="max-w-6xl mx-auto">

    <div class="section-label">📬 Kontakt</div>
    <h2 class="section-title">Nehmen Sie <em>Kontakt</em> auf</h2>
    <p class="section-lead">Wir beantworten gerne Ihre Fragen zu unserem Verein.</p>

    <div class="grid grid-cols-2 gap-16 mt-14 items-start">

      {{-- Contact info --}}
      <div class="flex flex-col gap-5">
        @foreach([
          ['📍', 'Adresse', 'NaturFreunde e.V. Ortsgruppe Traunreut<br>83301 Traunreut, Bayern'],
          ['📞', 'Telefon', '<a href="tel:+4986219003115" class="text-green-accent">+49 8621 9003115</a>'],
          ['✉️', 'E-Mail', '<a href="mailto:info@naturfreunde-traunreut.de" class="text-green-accent">info@naturfreunde-traunreut.de</a>'],
          ['📱', 'Social Media', 'Folgen Sie uns auf <a href="#" class="text-green-accent">Instagram</a> und <a href="#" class="text-green-accent">Facebook</a>'],
        ] as [$icon, $label, $value])
          <div class="flex gap-4 items-start bg-cream rounded-xl p-5 hover:-translate-y-0.5
                      transition-transform duration-200 shadow-sm hover:shadow-md">
            <div class="w-11 h-11 flex-shrink-0 bg-green-accent/10 rounded-xl flex items-center justify-center text-xl">
              {{ $icon }}
            </div>
            <div>
              <h4 class="font-nunito text-sm font-bold mb-1">{{ $label }}</h4>
              <p class="text-sm text-gray-500">{!! $value !!}</p>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Contact form --}}
      <div class="bg-cream rounded-2xl p-10 shadow-md">
        <h3 class="font-playfair text-2xl text-green-deep mb-7">Nachricht senden</h3>

        @if(session('success'))
          <div class="mb-6 px-5 py-4 bg-green-accent/10 border border-green-accent/30 rounded-xl text-green-deep text-sm font-semibold">
            ✓ {{ session('success') }}
          </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}">
          @csrf

          <div class="mb-5">
            <label class="block text-sm font-semibold mb-2">Ihr Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Max Mustermann"
                   class="w-full px-4 py-3 rounded-xl border-2 border-cream-dark bg-white font-nunito text-[15px]
                          focus:border-green-accent focus:ring-4 focus:ring-green-accent/10 outline-none transition-all">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
          </div>

          <div class="mb-5">
            <label class="block text-sm font-semibold mb-2">E-Mail-Adresse</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="max@beispiel.de"
                   class="w-full px-4 py-3 rounded-xl border-2 border-cream-dark bg-white font-nunito text-[15px]
                          focus:border-green-accent focus:ring-4 focus:ring-green-accent/10 outline-none transition-all">
            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
          </div>

          <div class="mb-6">
            <label class="block text-sm font-semibold mb-2">Ihre Nachricht</label>
            <textarea name="message" rows="4" placeholder="Ich interessiere mich für..."
                      class="w-full px-4 py-3 rounded-xl border-2 border-cream-dark bg-white font-nunito text-[15px]
                             focus:border-green-accent focus:ring-4 focus:ring-green-accent/10 outline-none transition-all resize-y">{{ old('message') }}</textarea>
            @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
          </div>

          <button type="submit"
                  class="w-full flex items-center justify-center gap-2 py-4 rounded-xl bg-green-mid text-white
                         font-semibold text-base hover:bg-green-accent hover:-translate-y-0.5
                         transition-all duration-200 shadow-sm hover:shadow-md">
            Nachricht senden ✓
          </button>
        </form>
      </div>

    </div>
  </div>
</section>
