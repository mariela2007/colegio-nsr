@extends('layouts.app')

@section('contenido')
<style>
    /* 1. CONFIGURACIÓN GENERAL (LOOK LIMPIO) */
    .contenido {
        padding: 0 !important;
        margin: 0 !important;
        background: #ffffff; /* Fondo blanco general como la referencia */
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #0d3b66;
    }

    :root {
        --c-blue: #0d3b66;      /* Azul Marino */
        --c-yellow: #ffca28;    /* Amarillo */
        --c-light-bg: #f8f9fa; /* Gris muy claro para secciones */
    }

    /* 2. HERO: FONDO OSCURO CON TEXTO CENTRADO (COMO image_0.png) */
    .hero-fullscreen {
        position: relative;
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px 10%;
        /* Usamos tu imagen de alumnos pero con overlay oscuro */
        background: linear-gradient(rgba(7, 42, 74, 0.8), rgba(9, 46, 80, 0.9)), 
                    url('imagen/colegio.jpeg');
        background-size: cover;
        background-position: center;
        color: white;
    }

    .hero-content {
        max-width: 850px;
    }

    .admisiones-tag {
        display: inline-block;
        background: rgba(255, 202, 40, 0.2);
        color: var(--c-yellow);
        padding: 8px 20px;
        border-radius: 50px;
        text-transform: uppercase;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 2px;
        margin-bottom: 20px;
        border: 1px solid var(--c-yellow);
    }

    .hero-content h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 25px;
    }

    .hero-content h1 span {
        color: var(--c-yellow);
    }

    .hero-content p {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 40px;
        font-weight: 400;
    }

    /* 3. SECCIÓN PILARES: TARJETAS BLANCAS (COMO image_1.png) */
    .section-pillars {
        padding: 100px 10%;
        background: #fcbf49;
        text-align: center;
    }

    .sub-title {
        text-transform: uppercase;
        color: var(--c-blue);
        font-weight: 700;
        letter-spacing: 3px;
        font-size: 0.8rem;
        margin-bottom: 10px;
        
    }

    .main-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: var(--c-blue);
        margin-bottom: 60px;
    }

    .pillars-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .pillar-card {
        background: white;
        padding: 50px 30px;
        border-radius: 20px;
        text-align: left;
        transition: 0.3s;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); /* Sombra suave */
        position: relative;
        overflow: hidden;
    }

    /* Borde amarillo inferior como image_1.png */
    .pillar-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: var(--c-blue);
        transform: scaleX(0);
        transition: 0.3s;
    }

    .pillar-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .pillar-card:hover::after {
        transform: scaleX(1);
    }

    .pillar-icon {
        width: 60px;
        height: 60px;
        background: #eef2f6;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--c-blue);
        font-size: 1.5rem;
        margin-bottom: 25px;
    }

    .pillar-card h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--c-blue);
        margin-bottom: 15px;
    }

    .pillar-card p {
        font-size: 1rem;
        color: #546e7a;
        line-height: 1.6;
    }

    /* 4. SECCIÓN INFRAESTRUCTURA (ESTILO image_2.png) */
    .section-infra {
        padding: 100px 10%;
        background: var(--c-light-bg); /* Fondo gris claro para contrastar */
    }

    .infra-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 50px;
    }

    .view-gallery {
        color: var(--c-blue);
        text-decoration: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: 0.3s;
    }

    .view-gallery:hover { color: var(--c-yellow); }

    .infra-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr; /* Mismo layout de image_2.png */
        gap: 20px;
    }

    .infra-item {
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .infra-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }

    .infra-item:hover img { transform: scale(1.05); }

    .infra-tag {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background: rgba(255,255,255,0.9);
        color: var(--c-blue);
        padding: 8px 15px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
    }

    /* Altura para imitar image_2.png */
    .img-big { height: 500px; }
    .img-small { height: 500px; }

    @media (max-width: 900px) {
        .infra-grid { grid-template-columns: 1fr; }
        .img-big, .img-small { height: 300px; }
    }

    /* 5. SECCIÓN FINAL CTA (ESTILO image_3.png) */
    .section-cta {
        padding: 60px 10%;
        background: #edf2f7; /* Fondo azul grisáceo muy claro */
        text-align: center;
    }

    .section-cta h2 {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--c-blue);
        margin-bottom: 15px;
    }

    .section-cta p {
        font-size: 1.1rem;
        color: #546e7a;
        margin-bottom: 40px;
    }

    /* 6. BOTONES (ESTILO image_0.png y image_3.png) */
    .btn-rosario {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 15px 35px;
        font-weight: 700;
        text-decoration: none;
        border-radius: 50px; /* Bordes muy redondeados */
        transition: 0.3s;
        font-size: 1rem;
    }

    /* Botón Amarillo Principal */
    .btn-filled {
        background: var(--c-yellow);
        color: var(--c-blue);
        box-shadow: 0 4px 15px rgba(255, 202, 40, 0.3);
    }

    .btn-filled:hover {
        background: #fbc02d;
        transform: translateY(-3px);
    }

    /* Botón Outline para Hero */
    .btn-outline {
        border: 2px solid rgba(255,255,255,0.5);
        color: white;
        margin-left: 15px;
    }

    .btn-outline:hover {
        background: white;
        color: var(--c-blue);
    }

    @media (max-width: 900px) {
        .pillars-grid { grid-template-columns: 1fr; }
        .hero-content h1 { font-size: 2.2rem; }
        .btn-outline { margin-left: 0; margin-top: 15px; width: 100%; justify-content: center;}
        .btn-filled { width: 100%; justify-content: center;}
    }



/* ===== FIX TOTAL MOBILE ===== */
@media (max-width: 768px) {

    /* HERO */
    .hero-fullscreen {
        min-height: auto;
        padding: 80px 20px 60px;
    }

    .hero-content {
        max-width: 100%;
    }

    .hero-content h1 {
        font-size: 2rem;
        line-height: 1.2;
    }

    .hero-content p {
        font-size: 1rem;
        margin-bottom: 25px;
    }

    /* BOTONES HERO */
   .hero-btns {
    display: flex;
    flex-direction: column;
    align-items: center; /* 👈 CENTRA sin estirar */
    gap: 12px;
}

.btn-rosario {
    width: auto; /* 👈 IMPORTANTE */
    min-width: 200px; /* 👈 tamaño bonito */
    justify-content: center;
}
    .btn-outline {
        margin-left: 0 !important;
    }

    /* SECCIONES */
    .section-pillars,
    .section-infra,
    .section-cta {
        padding: 60px 20px;
    }

    .main-title {
        font-size: 1.8rem;
        margin-bottom: 40px;
    }

    /* PILARES */
    .pillars-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .pillar-card {
        padding: 30px 20px;
    }

    /* INFRA */
    .infra-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .infra-grid {
        grid-template-columns: 1fr;
    }

    .img-big,
    .img-small {
        height: 250px;
    }

    /* CTA */
    .section-cta h2 {
        font-size: 1.8rem;
    }

    .section-cta p {
        font-size: 1rem;
    }
}

.pillar-img {
    width: 100%;
    height: 180px;
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 20px;
}

.pillar-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
  .infra-header .sub-title {
    position: relative;
    left: -200px; /* laptop */
}

/* 📱 celular */
@media (max-width: 768px) {
    .infra-header .sub-title {
        left: 0; /* centrado o normal */
        text-align: center;
    }
}  
</style>

<div class="hero-fullscreen">
    <div class="hero-content">
        <div class="admisiones-tag">Admisiones 2026 Abiertas</div>
        <h1>Forjando el Futuro con <br><span>Excelencia y Valores</span></h1>
        <p>Bienvenidos a la Institución Educativa Nuestra Señora del Rosario. Descubre un entorno donde el aprendizaje inspira y transforma.</p>
        <div class="hero-btns">
            <a href="/programas" class="btn-rosario btn-filled">Explorar Programas <span>→</span></a>
            <a href="/contacto" class="btn-rosario btn-outline">Contactar Asesor</a>
        </div>
    </div>
</div>

<div class="section-pillars">
    <div class="sub-title">Nuestra Esencia</div>
    <h2 class="main-title">Pilares de Nuestra Educación</h2>
    
    <div class="pillars-grid">

        <div class="pillar-card">
            <div class="pillar-img">
                <img src="{{ asset('imagen/imagen3.jpg') }}">
            </div>
            <h3>Excelencia Académica</h3>
            <p>Programas educativos innovadores que preparan a nuestros estudiantes para los desafíos del futuro globalizado.</p>
        </div>

        <div class="pillar-card">
            <div class="pillar-img">
                <img src="{{ asset('imagen/imagen2.jpg') }}">
            </div>
            <h3>Formación Integral</h3>
            <p>Desarrollo de habilidades sociales, emocionales y valores éticos que forman ciudadanos responsables.</p>
        </div>

        <div class="pillar-card">
            <div class="pillar-img">
                <img src="{{ asset('imagen/imagen1.jpg') }}">
            </div>
            <h3>Compromiso Social</h3>
            <p>Fomentamos la participación activa en la comunidad y la conciencia social.</p>
        </div>

    </div>
</div>

<div class="section-infra">
    <div class="infra-header">
        <div>
  <div class="sub-title" style="color: var(--c-yellow);">
    Vida Estudiantil
</div>
        <h2 class="main-title" style="margin-bottom: 0;">Espacios para el Aprendizaje</h2>
        </div>
        <a href="/biblioteca" class="view-gallery">Ver Galería Completa <span>→</span></a>
    </div>
    
    <div class="infra-grid">
        <div class="infra-item img-big">
            <img src="{{ asset('imagen/patio1.jpg') }}">
            <span class="infra-tag">Patio Escolar</span>
        </div>
        <div class="infra-item img-small">
            <img src="{{ asset('imagen/salon.jpg') }}">
            <span class="infra-tag">Aula de Clases</span>
        </div>
    </div>
</div>

<div class="section-cta">
    <h2>¿Listo para ser parte de nuestra familia?</h2>
    <p>Inicia el proceso de admisión hoy mismo y asegura un futuro brillante para tus hijos.</p>
    <a href="/contacto" class="btn-rosario btn-filled" style="padding: 18px 50px; font-size: 1.1rem;">Solicitar Información</a>
</div>

@endsection