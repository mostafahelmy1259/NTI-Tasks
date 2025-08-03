<!DOCTYPE html>
<html>
<head>
  <!-- {{-- @yield('title', 'Laravel App') - Placeholder for page title, default is 'Laravel App' --}} -->
  <title>@yield('title', 'Laravel App')</title>
  
  <!-- {{-- @vite - Loads compiled CSS and JavaScript files --}} -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <!-- {{-- @include - Includes the navbar partial file --}} -->
  @include('layouts.navbar')
  
  <!-- Main content area -->
  <main class="py-4">
    <!-- {{-- @yield('content') - Placeholder for main page content --}} -->
    @yield('content')
  </main>
</body>
</html>
