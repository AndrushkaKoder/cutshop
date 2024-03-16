@include('layout.head')

<body x-data="{ 'showTaskUploadModal': false, 'showTaskEditModal': false }" x-cloak>
@include('layout.header')

@yield('content')

</body>
@include('layout.footer')
