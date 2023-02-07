{{-- struttura html base di un progetto Vue.js --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ config('app.name') }}</title>
    {{-- importare il javascript --}}
    <script src="{{ asset('js/front.js') }}" defer></script>
</head>
<body>
	<div id="root"></div>

    {{-- <script src="{{ asset('js/front.js') }}"></script> --}}
</body>
</html>
