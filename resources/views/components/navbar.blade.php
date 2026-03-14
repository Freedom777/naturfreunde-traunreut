<style>
  #navbar { position:fixed; top:0; left:0; right:0; z-index:100; display:flex; align-items:center; justify-content:space-between; padding:0 40px; height:72px; background:rgba(30,58,15,0.96); backdrop-filter:blur(12px); box-shadow:0 2px 24px rgba(0,0,0,.25); }
  .nav-brand { display:flex; align-items:center; gap:14px; text-decoration:none; }
  .nav-logo { width:44px; height:44px; border-radius:50%; background:#c8861a; display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-size:20px; font-weight:900; color:#fff; flex-shrink:0; }
  .nav-title { color:#fff; font-family:'Playfair Display',serif; font-size:17px; font-weight:600; line-height:1.2; }
  .nav-title span { display:block; font-size:11px; font-family:'Nunito',sans-serif; font-weight:300; opacity:.7; letter-spacing:1px; text-transform:uppercase; }
  .nav-links { display:flex; align-items:center; gap:4px; }
  .nav-links a { color:rgba(255,255,255,0.85); text-decoration:none; font-size:14px; font-weight:500; padding:8px 14px; border-radius:8px; transition:all .2s; }
  .nav-links a:hover { color:#fff; background:rgba(255,255,255,.12); }
  .nav-links a.active { color:#e8a832; }
  .nav-links a.nav-cta { background:#c8861a; color:#fff !important; font-weight:600; margin-left:6px; }
  .nav-links a.nav-cta:hover { background:#e8a832; }
</style>

<nav id="navbar">
    <a class="nav-brand" href="{{ route('home') }}">
        <div class="nav-logo">NF</div>
        <div class="nav-title">
            NaturFreunde Traunreut
            <span>e.V. — Ortsgruppe</span>
        </div>
    </a>

    <div class="nav-links">
        <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a>
        <a href="{{ route('home') }}#veranstaltungen">Veranstaltungen</a>
        <a href="{{ route('gallery') }}" @class(['active' => request()->routeIs('gallery')])>Galerie</a>
        <a href="{{ route('home') }}#verein">Über uns</a>
        <a href="{{ route('home') }}#kontakt">Kontakt</a>
        <a href="{{ route('home') }}#mitglied" class="nav-cta">Mitglied werden</a>
    </div>
</nav>