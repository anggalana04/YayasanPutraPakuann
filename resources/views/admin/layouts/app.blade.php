<!DOCTYPE html>
<html lang="id" style="margin:0; padding:0; background:#f7f7f4;">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="Halaman masuk admin Yayasan Putra Pakuan." />
    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="icon" type="image/jpeg" href="{{ asset('images/yayasan-logo.jfif') }}" />
    <link rel="shortcut icon" type="image/jpeg" href="{{ asset('images/yayasan-logo.jfif') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/yayasan-logo.jfif') }}" />
    <title>Masuk Admin - Yayasan Putra Pakuan</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#f2cc0d",
                        "primary-container": "#fbd51d",
                        "primary-dim": "#5f4e00",
                        "charcoal": "#1c190d",
                        "on-primary-fixed": "#433700",
                        "on-surface-variant": "#5a5c5a",
                        "surface-container-low": "#f0f1ee",
                        "surface-container-lowest": "#ffffff",
                        "white": "#fff",
                        "red-600": "#dc2626",
                    },
                },
            },
        }
    </script>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
        }

        body { font-family: 'Lexend', sans-serif; }
    </style>
</head>
<body style="margin:0; padding:0;" class="bg-background min-h-screen">
    @yield('content')
</body>
</html>




