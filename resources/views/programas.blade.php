@extends('layouts.app')

@section('contenido')

<style>
html {
    scroll-behavior: smooth;
}

/* FULL WIDTH */
body {
    margin: 0;
}

.container {
    max-width: 100% !important;
    padding: 0 !important;
}

/* GENERAL */
.contenido {
    padding: 0 !important;
    margin: 0 !important;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

:root {
    --c-blue: #0d3b66;
    --c-yellow: #ffca28;
}

/* CABECERA */
.section-aviso {
    padding:60px 10%;
    background: var(--c-blue);
    color: white;
    text-align: center;
}

.section-aviso h2 {
    font-size: 2.5rem;
}
.section-aviso p {
    font-size: 1.1rem;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.6;
    opacity: 0.95;
}
.linea-amarilla {
    width: 90px;
    height: 6px;
    background: var(--c-yellow);
    margin: 20px auto;
    border-radius: 3px;
}

/* PROGRAMAS */

/* ======================
   PROGRAMAS / TARJETAS
====================== */
.section {
    padding: 60px 10%;
    text-align: center;
    background: #fcbf49;
}

/* GRID */
.pillars-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

/* TITULO */
.sub-title {
    text-transform: uppercase;
    color: var(--c-blue);
    font-weight: 700;
    letter-spacing: 2px;
    font-size: 0.75rem;
    margin-bottom: 29px;
    margin-top: -2px;
}

/* CARD */
.pillar-card {
    background: white;
    border-radius: 18px;
    overflow: hidden;
    padding: 0; /* 🔥 importante */
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
    position: relative;

    display: flex;
    flex-direction: column;
}

.pillar-card.show {
    opacity: 1;
    transform: translateY(0);
}

/* HOVER CARD */
.pillar-card:hover {
    transform: translateY(-6px) scale(1.01);
    box-shadow: 0 14px 28px rgba(0,0,0,0.12);
}

/* IMAGEN */
.circle-img {
    width: 100%;
    height: 200px; /* 🔥 más grande */
    overflow: hidden;
    position: relative;
    border-radius: 0; /* 🔥 quitamos bordes redondos arriba */
}

.circle-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

/* 🔥 zoom */
.pillar-card:hover img {
    transform: scale(1.1);
}

/* TITULO */
.pillar-card h3 {
    margin: 15px;
    font-size: 18px;
    color: var(--c-blue);
}

/* BOTÓN (CORREGIDO PRO) */
.btn-programa {
    margin: 15px;
    padding: 10px;
    background: var(--c-blue);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    text-align: center;
    transition: 0.3s;
}

.btn-programa:hover {
    background: #000;
    transform: translateY(-2px);
}


/* LÍNEA ANIMADA */
.pillar-card::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--c-blue);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease;
}
.pillar-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}
.pillar-card:hover::after {
    transform: scaleX(1);
}

.pillar-card.active::after {
    transform: scaleX(1);
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .pillars-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .pillars-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .pillar-card {
        padding: 18px;
    }

    .circle-img {
        height: 180px;
    }

    .pillar-card h3 {
        font-size: 18px;
    }

    .btn-programa {
        width: auto;        /* 🔥 FIX móvil */
        min-width: 140px;   /* mantiene forma botón */
        font-size: 0.9rem;
    }
}




/* DETALLE */

.programa-section{
    padding: 60px 10%;
    background: #ffffff;
    scroll-margin-top: 100px;
    margin-top: 0;

}

.programa-section.alt{
    background: #f7f9fc;
}

.programa-flex{
    display: flex;
    align-items: center;
    gap: 40px;
}

.programa-section.alt .programa-flex{
    flex-direction: row-reverse;
}

/* IMAGEN */
.programa-img{
    width: 50%;
    height: 300px;
    border-radius: 16px;
    overflow: hidden;
}

.programa-img img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.4s;
}

.programa-img img:hover{
    transform: scale(1.05);
}

/* CONTENIDO */
.programa-content{
    width: 50%;
}

/* HEADER */
.programa-header{
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
    border-left: 4px solid var(--c-blue);
    padding-left: 14px;
}

.programa-header .icon i{
    font-size: 28px;
    color: var(--c-blue);
}

.programa-header h2{
    color: var(--c-blue);
    font-size: 28px;
}

/* TEXTO */
.descripcion{
    margin-bottom: 30px;
    color: #444;
}

/* GRID */
.info-grid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

/* BOX */
.info-box{
    background: #ffffff;
    padding: 18px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    transition: 0.3s;
}

.info-box:hover{
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.10);
}

.info-box h4{
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--c-blue);
}

.info-box i{
    color: var(--c-blue);
}

/* RESPONSIVE */
@media (max-width: 900px){
    .programa-flex{
        flex-direction: column;
    }

    .programa-img,
    .programa-content{
        width: 100%;
    }

    .programa-img{
        height: 220px;
    }

    .info-grid{
        grid-template-columns: 1fr;
    }

    .programa-section{
        padding: 60px 6%;
    }
}

</style>

<!-- CABECERA -->
<div class="section-aviso">
    <h2>Formación Académica</h2>
    <div class="linea-amarilla"></div>
    <p>Brindamos una educación integral que fortalece los conocimientos, valores y habilidades de nuestros estudiantes en cada etapa de su desarrollo.</p>
</div>

<!-- CARDS -->
<div class="section">
   <div class="sub-title">Programas Académicos</div>
    <div class="pillars-grid">

        <div class="pillar-card">
            <div class="circle-img">
                <img src="{{ asset('imagen/inicial.jpg') }}">
            </div>
            <h3>Inicial</h3>
            <p> Los niños inician su aprendizaje escolar jugando, creando y conviviendo, desarrollando habilidades básicas y sociales.</p>
            <a href="#inicial" class="btn-programa">Ver más</a>
        </div>

        <div class="pillar-card">
            <div class="circle-img">
                <img src="{{ asset('imagen/primaria.jpg') }}">
            </div>
            <h3>Primaria</h3>
            <p> Se fortalecen las bases del aprendizaje como lectura, escritura y matemáticas,
        junto con la formación en valores y hábitos de estudio.</p>
            <a href="#primaria" class="btn-programa">Ver más</a>
        </div>

        <div class="pillar-card">
            <div class="circle-img">
                <img src="{{ asset('img/secundaria.jpg') }}">
            </div>
            <h3>Secundaria</h3>
            <p>Se refuerzan los conocimientos académicos y se prepara al estudiante para estudios superiores
        o su inserción en el mundo laboral.</p>
            <a href="#secundaria" class="btn-programa">Ver más</a>
        </div>

    </div>
</div>

<!-- DETALLE PROGRAMAS -->
<!-- INICIAL -->
<section id="inicial" class="programa-section">
    <div class="programa-flex">

        <!-- IMAGEN -->
        <div class="programa-img">
            <img src="{{ asset('imagen/inicial.jpg') }}" alt="">
        </div>

        <!-- CONTENIDO -->
        <div class="programa-content">
            <div class="programa-header">
                <span class="icon"><i class="fa-solid fa-child"></i></span>
                <h2>Inicial</h2>
            </div>

            <p class="descripcion">
                Educación inicial enfocada en el desarrollo emocional, social y creativo del niño.
            </p>

            <div class="info-grid">
                <div class="info-box">
                    <h4><i class="fa-solid fa-user"></i> Edades</h4>
                    <p>3 a 5 años</p>
                </div>

                <div class="info-box">
                    <h4><i class="fa-solid fa-book"></i> Áreas</h4>
                    <ul>
                        <li>Comunicación</li>
                        <li>Psicomotricidad</li>
                        <li>Arte y creatividad</li>
                    </ul>
                </div>

                <div class="info-box">
                    <h4><i class="fa-solid fa-clock"></i> Horario</h4>
                    <p>8:00 a.m. – 12:00 p.m.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- PRIMARIA -->
<section id="primaria" class="programa-section alt">
    <div class="programa-flex">

        <div class="programa-img">
            <img src="{{ asset('imagen/primaria.jpg') }}" alt="">
        </div>

        <div class="programa-content">
            <div class="programa-header">
                <span class="icon"><i class="fa-solid fa-book-open"></i></span>
                <h2>Primaria</h2>
            </div>

            <p class="descripcion">
                Formación académica sólida con valores, hábitos de estudio y pensamiento lógico.
            </p>

            <div class="info-grid">
                <div class="info-box">
                    <h4><i class="fa-solid fa-user"></i> Edades</h4>
                    <p>6 a 11 años</p>
                </div>

                <div class="info-box">
                    <h4><i class="fa-solid fa-book"></i> Cursos</h4>
                    <ul>
                        <li>Matemática</li>
                        <li>Comunicación</li>
                        <li>Ciencia</li>
                    </ul>
                </div>

                <div class="info-box">
                    <h4><i class="fa-solid fa-clock"></i> Horario</h4>
                    <p>7:45 a.m. – 1:30 p.m.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- SECUNDARIA -->
<section id="secundaria" class="programa-section">
    <div class="programa-flex">

        <div class="programa-img">
            <img src="{{ asset('img/secundaria.jpg') }}" alt="">
        </div>

        <div class="programa-content">
            <div class="programa-header">
                <span class="icon"><i class="fa-solid fa-graduation-cap"></i></span>
                <h2>Secundaria</h2>
            </div>

            <p class="descripcion">
                Preparación académica y vocacional para estudios superiores y el mundo laboral.
            </p>

            <div class="info-grid">
                <div class="info-box">
                    <h4><i class="fa-solid fa-user"></i> Edades</h4>
                    <p>12 a 16 años</p>
                </div>

                <div class="info-box">
                    <h4><i class="fa-solid fa-book"></i> Cursos</h4>
                    <ul>
                        <li>Matemática</li>
                        <li>Comunicación</li>
                        <li>Inglés</li>
                    </ul>
                </div>

                <div class="info-box">
                    <h4><i class="fa-solid fa-clock"></i> Horario</h4>
                    <p>7:30 a.m. – 2:30 p.m.</p>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- ANIMACIÓN -->
<script>
const elementos = document.querySelectorAll('.pillar-card, .detalle-programa');

window.addEventListener('scroll', () => {
    elementos.forEach(el => {
        const pos = el.getBoundingClientRect().top;
        const screen = window.innerHeight;

        if (pos < screen - 100) {
            el.classList.add('show');
        }
    });
});
</script>

@endsection