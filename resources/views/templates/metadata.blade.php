<meta name="csrf-token" content="{{ csrf_token() }}">

<meta charset="UTF-8">
<meta name="description" content="{{ (isset($metadata['description'])) ? ($metadata['description']) : 'AkisList is a free service that helps you buy or sell used items securely and professionally. We try our best to make sure that the usage of our service is secure and in a professional manner. We try our hardest to eliminate scammers, frauds, exploiters or any illegitimate items being sold on our platform.' }}">
<meta name="keywords" content="{{ (isset($metadata['keywords'])) ? ($metadata['keywords']) : 'AkisList, buy and sell online, buying and selling used items, secure, safe, online store, free service' }}">
<meta name="author" content="{{ (isset($metadata['author'])) ? ($metadata['author']) : 'Akkarachai Wangcharoensap (Aki)'}}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- Social Media --}}
<meta property="og:title" content="{{ isset(($metadata['title'])) ? ($metadata['title']) : 'Akislist'}}">
<meta property="og:image" content="">
<meta property="og:description" content="{{ isset(($metadata['description'])) ? ($metadata['description']) : 'AkisList is a free service that helps you buy or sell used items securely and professionally. We try our best to make sure that the usage of our service is secure and in a professional manner. We try our hardest to eliminate scammers, frauds, exploiters or any illegitimate items being sold on our platform.' }}">

{{-- Book marking / app logo --}}
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('images/favicons/site.webmanifest') }}">
<link rel="mask-icon" href="{{ asset('images/favicons/safari-pinned-tab.svg') }}" color="#21a07e">
<meta name="msapplication-TileColor" content="#21a07e">
<meta name="theme-color" content="#ff0000">

<title>{{ isset(($metadata['title'])) ? ($metadata['title']) : 'Akislist'}}</title>