<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'SheepHub')</title>
  @stack('styles')
</head>
<body>
  <aside class="sidebar">
    @include('partials.sidebar')
  </aside>

  <div class="main-content">
    <header class="top-bar">
      @include('partials.topbar')
    </header>

    <main>
      @yield('content')
    </main>
  </div>

  @stack('scripts')
</body>
</html>
