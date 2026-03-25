<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login - Yayasan Putra Pakuan</title>
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
        body { font-family: 'Lexend', sans-serif; }
    </style>
</head>
<body class="bg-background min-h-screen">
    @yield('content')
</body>
</html>
