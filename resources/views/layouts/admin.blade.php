<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Panel administrativo') | Colegio NSR</title>
    <!-- Font Awesome para iconos profesionales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1; /* Indigo moderno */
            --primary-hover: #4f46e5;
            --bg-dark: #0f172a;
            --sidebar-bg: #1e293b;
            --card-bg: rgba(30, 41, 59, 0.7);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --accent: #fbbf24;
        }

        * {
            box-sizing: border-box;
            transition: all 0.2s ease-in-out;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--text-main);
            background-color: var(--bg-dark);
            background-image: radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, rgba(251, 191, 36, 0.05) 0px, transparent 50%);
        }

        .admin-shell {
            display: grid;
            grid-template-columns: 280px 1fr;
            min-height: 100vh;
        }

        /* Sidebar Estilizada */
        .admin-sidebar {
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 2.5rem;
            padding-left: 10px;
        }

        .brand i {
            color: var(--accent);
        }

        .nav-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .admin-sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-muted);
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .admin-sidebar a i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .admin-sidebar a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-main);
        }

        .admin-sidebar a.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 2rem;
        }

        /* Área Principal */
        .admin-main {
            padding: 40px;
            overflow-y: auto;
        }

        .admin-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .admin-header h1 {
            margin: 0;
            font-size: 1.875rem;
            font-weight: 800;
            letter-spacing: -0.025em;
        }

        .admin-header p {
            margin: 5px 0 0;
            color: var(--text-muted);
        }

        /* Contenedor de Contenido (Yield) */
        .content-wrapper {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* Botón de ejemplo para que veas el estilo */
        .btn-action {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .admin-shell {
                grid-template-columns: 1fr;
            }
            .admin-sidebar {
                display: none; /* Aquí podrías añadir un menú hamburguesa */
            }
        }
    </style>
</head>
<body>
    <div class="admin-shell">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="brand">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>NSR Admin</span>
            </div>

            <nav class="nav-group">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie"></i> Inicio
                </a>
                <a href="{{ route('admin.noticias') }}" class="{{ request()->routeIs('admin.noticias') ? 'active' : '' }}">
                    <i class="fa-solid fa-newspaper"></i> Noticias
                </a>
                <a href="{{ route('admin.eventos') }}" class="{{ request()->routeIs('admin.eventos') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar-check"></i> Eventos
                </a>
                <a href="{{ route('admin.imagenes') }}" class="{{ request()->routeIs('admin.imagenes') ? 'active' : '' }}">
                    <i class="fa-solid fa-images"></i> Galería
                </a>
                <a href="{{ route('admin.contactos') }}" class="{{ request()->routeIs('admin.contactos') ? 'active' : '' }}">
    <i class="fa-solid fa-envelope"></i> Contactos
</a>
            </nav>

            <div class="sidebar-footer">
                <a href="/" style="border: 1px solid var(--border-color)">
                    <i class="fa-solid fa-house"></i> Volver a la Web
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <header class="admin-header">
                <div>
                    <h1>@yield('titulo', 'Dashboard')</h1>
                    <p>Bienvenido al sistema de gestión académica.</p>
                </div>
                <!-- Espacio para un botón de acción rápida o usuario -->
                <div class="user-pill" style="background: var(--sidebar-bg); padding: 8px 16px; border-radius: 50px; border: 1px solid var(--border-color); font-size: 0.85rem;">
                    <i class="fa-solid fa-circle-user" style="color: var(--accent)"></i> Administrador
                </div>
            </header>

            <section class="content-wrapper">
                @yield('contenido')
            </section>
        </main>
    </div>
</body>
</html>