<input type="search" placeholder="Pesquisar" class="pesquisa" />
<img src="{{ asset('imgfeed/Vector.png') }}" alt="Lupa" class="lupa" />
<div class="user-info">
  <img src="{{ asset('img/fotodeperfil.png') }}" alt="User Avatar" />
  <span>{{ auth()->user()->name ?? 'Usuário' }}</span>
</div>
