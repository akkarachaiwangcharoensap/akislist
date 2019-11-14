<meta name="robots" content="noindex, nofollow">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta charset="UTF-8">

{{-- Book marking / app logo --}}
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('images/favicons/site.webmanifest') }}">
<link rel="mask-icon" href="{{ asset('images/favicons/safari-pinned-tab.svg') }}" color="#21a07e">
<meta name="msapplication-TileColor" content="#21a07e">
<meta name="theme-color" content="#ff0000">

<title>{{ isset(($metadata['title'])) ? ($metadata['title']) : 'Akislist'}}</title>
