@php
use Illuminate\Support\Str;
use App\Models\Pokdarwis;

// Ambil pokdarwis milik user login (atau dari variabel yang dipass)
$pdw = $pokdarwis
    ?? (auth()->check() ? Pokdarwis::where('user_id', auth()->id())->first() : null);

// Bangun URL avatar (http/https | public/assets | storage)
$avatar = $pdw?->img;
if ($avatar) {
    $avatar = Str::startsWith($avatar, ['http://','https://','//'])
        ? $avatar
        : (Str::startsWith($avatar, 'assets/')
            ? asset($avatar)
            : asset('storage/'.$avatar));
} else {
    $avatar = asset('assets/images/default.png');
}

// Field untuk UI
$name   = $pdw->name_pokdarwis ?? '—';
$desc   = $pdw->deskripsi      ?? null;   // ← pakai 'deskripsi'
$lokasi = $pdw->lokasi         ?? null;
@endphp

<style>
  /* Pastikan avatar benar-benar bulat dan cover */
  .offcanvas-sidebar .profile .avatar img{
    width:120px; height:120px;
    border-radius:50%;
    object-fit:cover; object-position:center;
    display:block; margin:0 auto;
    border: 1px solid #e5e7eb;
    background:#fff;
  }
</style>

<div id="offCanvas" class="offcanvas-container">
  <div class="offcanvas-inner">
    <div class="offcanvas-sidebar">

      <aside class="widget author_widget">
        <h3 class="widget-title">PROFILE</h3>

        @if($pdw)
          <div class="widget-content text-center">
            <div class="profile">
              <figure class="avatar">
                <img
                  src="{{ $avatar }}"
                  alt="{{ $name }}"
                  onerror="this.onerror=null;this.src='{{ asset('assets/images/default.png') }}'">
              </figure>

              <div class="text-content">
                <div class="name-title"><h4>{{ $name }}</h4></div>

                @if($desc)
                  <p>{{ $desc }}</p>
                @else
                  <p class="text-muted">No description yet.</p>
                @endif
              </div>

              {{-- Socials: tampil hanya jika ada --}}
              @if(!empty($pdw->facebook) || !empty($pdw->twitter) || !empty($pdw->instagram) || !empty($pdw->website) || !empty($pdw->pinterest) || !empty($pdw->google))
                <div class="socialgroup mt-3">
                  <ul>
                    @if(!empty($pdw->facebook))  <li><a target="_blank" href="{{ $pdw->facebook  }}"><i class="fab fa-facebook"></i></a></li>@endif
                    @if(!empty($pdw->google))    <li><a target="_blank" href="{{ $pdw->google    }}"><i class="fab fa-google"></i></a></li>@endif
                    @if(!empty($pdw->twitter))   <li><a target="_blank" href="{{ $pdw->twitter   }}"><i class="fab fa-twitter"></i></a></li>@endif
                    @if(!empty($pdw->instagram)) <li><a target="_blank" href="{{ $pdw->instagram }}"><i class="fab fa-instagram"></i></a></li>@endif
                    @if(!empty($pdw->pinterest)) <li><a target="_blank" href="{{ $pdw->pinterest }}"><i class="fab fa-pinterest"></i></a></li>@endif
                    @if(!empty($pdw->website))   <li><a target="_blank" href="{{ $pdw->website   }}"><i class="fas fa-globe"></i></a></li>@endif
                  </ul>
                </div>
              @endif
            </div>
            
          </div>
        @else
          <div class="widget-content text-center">
            <p class="text-muted mb-2">Belum terhubung ke profil Pokdarwis.</p>
            <a class="btn btn-sm btn-primary" href="{{ route('login') }}">Login</a>
          </div>
        @endif
      </aside>

      <aside class="widget widget_text text-center">
        <h3 class="widget-title">CONTACT US</h3>
        <div class="textwidget widget-text">
          <p>Feel free to contact and<br/> reach us !!</p>
          <ul>
            @if(!empty($pdw?->phone))
              <li><a href="tel:{{ $pdw->phone }}"><i class="icon icon-phone1"></i> {{ $pdw->phone }}</a></li>
            @endif
            @if(!empty($pdw?->email))
              <li><a href="mailto:{{ $pdw->email }}"><i class="icon icon-envelope1"></i> {{ $pdw->email }}</a></li>
            @endif
            @if(!empty($lokasi))
              <li><i class="icon icon-map-marker1"></i> {{ $lokasi }}</li>
            @endif
          </ul>
          
            <div class="mt-3">
                <a href="{{ route('profile.index') }}" class="btn btn-sm btn-outline-primary">
                  <i class="fas fa-user-cog me-1"></i> Profile Settings
                </a>
              </div>
        </div>
      </aside>

      <a href="#" class="offcanvas-close"><i class="fas fa-times"></i></a>
    </div>
    
  </div>
  <div class="overlay"></div>
</div>
