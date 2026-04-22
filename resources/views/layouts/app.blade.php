<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <title>Colegio NSR | Excelencia Educativa</title>
    <style>
        :root {
            --azul-oscuro: #0d3b66;
            --amarillo: #fcbf49;
            --amarillo-transp: rgba(252, 191, 73, 0.15);
            --blanco: #ffffff;
            --gris-claro: #f4f4f4;
            --texto: #333;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--azul-oscuro); /* Cambiado a azul para que al final no quede blanco */
            color: var(--texto);
            line-height: 1.6;
        }

        /* --- NAVBAR --- */
        .navbar {
            background: var(--azul-oscuro);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 10%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
        }

            .logo img {
    width: 70px;
    height: 70px;
    object-fit: contain;
    transition: all 0.3s ease;
}

/* hover (como el menú) */
.logo:hover img {
    background: var(--amarillo-transp);
    border-radius: 10px;
}

/* active (cuando está seleccionado) */
.logo:active img {
    background: var(--amarillo);
    box-shadow: 0 4px 12px rgba(252, 191, 73, 0.3);
    border-radius: 10px;
}

        .logo-text {
            color: var(--blanco);
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        /* --- MENÚ DE NAVEGACIÓN --- */
        .menu {
            display: flex;
            gap: 10px;
        }

        .menu a {
            color: var(--blanco);
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 30px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
        }

        .menu a:hover:not(.active) {
            background: var(--amarillo-transp);
            color: var(--amarillo);
        }

        .menu a.active {
            background: var(--amarillo);
            color: var(--azul-oscuro);
            box-shadow: 0 4px 12px rgba(252, 191, 73, 0.3);
        }

        /* BOTON MOVIL (NUEVO) */
        .menu-btn {
            display: none;
            color: var(--amarillo);
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* --- CONTENIDO PRINCIPAL --- */
        .contenido {
            min-height: 60vh;
            padding: 60px 10%;
            text-align: center;
            background: white; /* El contenido sigue siendo blanco */
            margin: 0; /* Quitamos el margin para que no se vea el fondo azul por los lados */
            border-radius: 0 0 30px 30px; /* Redondeamos solo abajo para estilo */
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        /* --- FOOTER --- */
        footer {
            background: var(--azul-oscuro);
            color: var(--blanco);
            padding: 60px 10% 20px;
            margin-top: 0; /* Quitamos el margin top para que pegue con el blanco */
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3, .footer-section h4 {
            color: var(--amarillo);
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .footer-section p, .footer-section li {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 12px;
        }

        .footer-section ul li a {
            color: var(--blanco);
            text-decoration: none;
            transition: 0.3s;
        }

        .footer-section ul li a:hover {
            color: var(--amarillo);
            padding-left: 5px;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

           
       .social-icons a {
    width: 40px;
    height: 40px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--azul-oscuro);
    font-size: 18px;
    transition: 0.3s;
}

.social-icons a:hover {
    transform: translateY(-5px);
}

/* colores por red */
.social-icons a:nth-child(1):hover { background: #1877f2; color: white; }
.social-icons a:nth-child(2):hover { background: #e1306c; color: white; }
.social-icons a:nth-child(3):hover { background: #000; color: white; }


.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
    font-size: 0.9rem;
    opacity: 0.9;
}

.contact-item i {
    color: var(--amarillo);
    font-size: 16px;
    min-width: 20px;
}

        .footer-bottom {
            text-align: center;
            padding-top: 25px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 0.8rem;
            color: rgba(255,255,255,0.6);
        }

.whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 25px;
    right: 25px;
    background-color: #25D366;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    z-index: 9999;
    transition: 0.3s ease;
    text-decoration: none;
}

.whatsapp-float:hover {
    transform: scale(1.1);
}



        /* AJUSTE PARA CELULAR (MODIFICADO) */
        @media (max-width: 768px) {
            .navbar { padding: 15px 5%; }
            .menu-btn { display: block; } /* Aparece el icono */
            .menu {
                display: none; /* Escondemos el menú normal */
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: var(--azul-oscuro);
                padding: 20px 0;
                border-top: 1px solid var(--amarillo-transp);
            }
            .menu.show { display: flex; } /* Se muestra al darle click */
            .menu a { border-radius: 0; text-align: center; }
            .logo-text { font-size: 0.9rem; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="/" class="logo">
        <img src="imagen/escudo2026.png" alt="Logo Colegio NSR">
        <div class="logo-text">I.E.I.P Nuestra Señora del Rosario</div>
    </a>

    <div class="menu-btn" id="btnNav">☰</div>

    <div class="menu" id="mainMenu">
        <a href="/" data-link>Inicio</a>
        <a href="/nosotros" data-link>Sobre Nosotros</a>
        <a href="/programas" data-link>Programas</a>
        <a href="/biblioteca" data-link>Noticias y eventos</a>
        <a href="/contacto" data-link>Contacto</a>
    </div>
</nav>

<main class="contenido">
    @yield('contenido')
</main>

<footer>
    <div class="footer-container">
        <div class="footer-section">
     <img src="imagen/escudo2026.png" alt="logo"
     style="width: 70px; height: auto; margin-bottom:15px;">
        <h3>Colegio NSR</h3>
            <p>Formando líderes del mañana con excelencia académica y valores sólidos desde 2006.</p>
        </div>

       <div class="footer-section">
    <h4>Contacto</h4>

    <div class="contact-item">
        <i class="fas fa-map-marker-alt"></i>
        <span>Av. Universitaria 3202, Pillco Marca</span>
    </div>

    <div class="contact-item">
        <i class="fas fa-phone"></i>
        <span>965 067 111</span>
    </div>

    <div class="contact-item">
        <i class="fas fa-envelope"></i>
        <span>ieip.ntrasrarosario@gmail.com</span>
    </div>
</div>

        <div class="footer-section">
            <h4>Enlaces</h4>
            <ul>
                <li><a href="/nosotros">Nosotros</a></li>
                <li><a href="/programas">Programa</a></li>
                <li><a href="/contacto">Contacto</a></li>
            </ul>
        </div>

        <div class="footer-section">
           <h4>Síguenos</h4>
<div class="social-icons">

<a href="https://www.facebook.com/p/Instituci%C3%B3n-Educativa-Nuestra-Se%C3%B1ora-del-Rosario-100063992527310/" target="_blank">
    <i class="fab fa-facebook-f"></i>
</a>

<a href="https://www.instagram.com/n_s_rosario/" target="_blank">
    <i class="fab fa-instagram"></i>
</a>

<a href="https://www.tiktok.com/@colegionsr?lang=es-419" target="_blank">
    <i class="fab fa-tiktok"></i>
</a>

</div>
        </div>
    </div>
  <div class="footer-bottom">
    &copy; <span id="year"></span> I.E. Nuestra Señora del Rosario - Todos los derechos reservados
</div>

<!-- WhatsApp flotante -->
<a href="https://wa.me/51965067111?text=Hola%2C%20quisiera%20recibir%20informaci%C3%B3n%20sobre%20el%20colegio.%20Me%20gustar%C3%ADa%20conocer%20el%20proceso%20de%20matr%C3%ADcula%2C%20horarios%20y%20requisitos."
   class="whatsapp-float"
   target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>
</footer>

<script>
    document.getElementById("year").textContent = new Date().getFullYear();
    document.addEventListener('DOMContentLoaded', () => {
        const menuLinks = document.querySelectorAll('[data-link]');
        const currentPath = window.location.pathname;
        const btnNav = document.getElementById('btnNav');
        const mainMenu = document.getElementById('mainMenu');

        // Toggle menú móvil
        btnNav.addEventListener('click', () => {
            mainMenu.classList.toggle('show');
        });

        // Marcar activo
        const setActive = (path) => {
            menuLinks.forEach(link => {
                if (link.getAttribute('href') === path) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        };

        setActive(currentPath);

        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                setActive(this.getAttribute('href'));
                mainMenu.classList.remove('show'); // Cerrar al clickear
            });
        });
    });
</script>

</body>
</html>