@extends('layouts.app')

@section('contenido')
<style>
/* ==============================
   CONFIGURACIÓN GENERAL
============================== */
.contenido {
    padding: 0 !important;
    margin: 0 !important;
    background: #ffffff;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #0d3b66;
}

:root {
    --c-blue: #0d3b66;
    --c-yellow: #ffca28;
    --c-light-bg: #f8f9fa;
}

/* ==============================
   SECCIONES
============================== */
.section {
    padding: 60px 10%;
    text-align: center;
}

.section.bg-light { 
    background: #fcbf49;
    color: var(--c-blue); 
}

.section.bg-white { 
    background: #0d3b66; 
    color: var(--c-blue); 
}

/* ==============================
   CABECERA
============================== */
.section-aviso {
    padding: 60px 10%;
    background: var(--c-blue);
    color: #ffffff;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.section-aviso h2 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    color: #ffffff !important;
}

.linea-amarilla {
    width: 70px;
    height: 6px;
    background-color: var(--c-yellow);
    margin: 15px 0 25px 0;
    border-radius: 3px;
}

.section-aviso p {
    color: #ffffff;
    font-size: 1.1rem;
    max-width: 700px;
    margin: 0;
    font-weight: 400;
}

/* ==============================
   TARJETAS: MISION Y VISION
============================== */
.pillars-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 30px;
}

.pillar-card {
    background: #ffffff;
    padding: 25px 20px;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.05);
    text-align: left;
    overflow: hidden;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.pillar-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.08);
}

.pillar-card::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: var(--c-blue);
    transform: scaleX(0);
    transition: transform 0.3s;
}

.pillar-card:hover::after {
    transform: scaleX(1);
}

.pillar-card h3 {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 10px;
    color: var(--c-blue);
}

.pillar-card p {
    font-size: 0.95rem;
    margin: 0;
    color: #0d3b66;
}

.pillar-img img {
    width: 100%;
    max-height: 200px; /* Limita la altura de la imagen */
    object-fit: cover; /* Ajusta la imagen sin deformarla */
    border-radius: 8px;
    margin-bottom: 15px; /* Ajusta el espacio debajo de la imagen */
}
/* ==============================
   TARJETAS: VALORES
============================= */

.values-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-top: 35px;
}
#valores .sub-title {
    color: #ffffff;
}
/* TARJETAS */
.value-card {
    background: #ffffff;
    padding: 22px 16px; /* más espacio */
    border-radius: 12px;
    box-shadow: 0 6px 14px rgba(0,0,0,0.05);
    text-align: center;

    position: relative;
    overflow: hidden;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.value-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 25px rgba(0,0,0,0.08);
}

/* LINEA AZUL */
.value-card::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--c-yellow);
    transform: scaleX(0);
    transition: transform 0.3s;
}

.value-card:hover::after {
    transform: scaleX(1);
}

/* ICONO */
.value-img img {
    width: 100px; /* más grande */
    height: 100px;
    margin-bottom: 12px;
}

/* TÍTULO */
.value-card h4 {
    font-size: 1.5rem;   /* MÁS GRANDE */
    font-weight: 800;    /* MÁS GRUESO */
    margin-bottom: 8px;
    color: #0d3b66;
}

/* TEXTO */
.value-card p {
    font-size: 0.95rem;  /* MÁS GRANDE */
    font-weight: 500;
    line-height: 1.5;
    color: #455a64;
}
    .main-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: #f4f4f4;
        margin-bottom: 60px;
    }

/* ==============================
   SUB-TITULOS
============================== */
.sub-title {
    text-transform: uppercase;
    color: var(--c-blue);
    font-weight: 700;
    letter-spacing: 2px;
    font-size: 0.8rem;
    margin-bottom: 10px;
}

/* ==============================
   RESPONSIVE
============================== */


/* CONTENEDOR */
.value-img {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    perspective: 800px;
    overflow: hidden;
}

/* IMAGEN */
.value-img img {
    width: 100px;
    height: 100px;
    transition: transform 0.6s ease;
    transform-style: preserve-3d;
    border-radius: 50%;
    position: relative;
    z-index: 1;
}

/* GIRO LIMPIO */
.value-card:hover .value-img img {
    transform: rotateY(360deg);
}

/* BRILLO (SIN ANIMATION) */
.value-img::after {
    content: '';
    position: absolute;
    top: 0;
    left: -120%;
    width: 60%;
    height: 100%;
    background: linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,0.7),
        transparent
    );
    transform: skewX(-20deg);
    transition: left 0.6s ease; /* CLAVE */
}

/* HOVER */
.value-card:hover .value-img::after {
    left: 120%;
}


@media (max-width: 900px) {
    .pillars-grid,
    .values-grid {
        grid-template-columns: 1fr;
    }

    .section h2 {
        font-size: 1.8rem;
    }

    .section-aviso h2 {
        font-size: 2rem;
    }

    .pillar-card h3,
    .value-card h4 {
        font-size: 1.1rem;
    }

    .pillar-card p,
    .value-card p {
        font-size: 0.9rem;
    }

    .sub-title {
        font-size: 0.7rem;
    }

    .section {
        padding: 40px 5%;
    }
}
/* ==============================
   HISTORIA
============================== */
.timeline-section {
    padding: 80px 10%;
    background-color: #fcbf49;
}

/* HEADER */
.timeline-header {
    text-align: center;
    margin-bottom: 40px;
}

.timeline-header span {
    color: #0d3b66;
    font-weight: bold;
    letter-spacing: 2px;
}

.timeline-header h2 {
    color: #0d3b66;
    font-size: 2.5rem;
    margin-top: 10px;
}

/* =========================
   TIMELINE CONTENEDOR
========================= */
.timeline {
    position: relative;
    max-width: 1100px;
    margin: 60px auto;
}

/* línea central */
.timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    width: 2px;
    height: 100%;
    background: #e0e0e0;
    transform: translateX(-50%);
}

/* =========================
   ITEM
========================= */
.timeline-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 60px;
    gap: 40px;
    position: relative;
}

/* alterna zigzag */
.timeline-item:nth-child(even) {
    flex-direction: row-reverse;
}

/* punto central */
.timeline-item::after {
    content: '';
    position: absolute;
    left: 50%;
    top: 40px;
    transform: translateX(-50%);
    width: 16px;
    height: 16px;
    background: #fcbf49;
    border: 4px solid #fff;
    border-radius: 50%;
    box-shadow: 0 0 0 3px #0d3b66;
}

/* =========================
   TEXTO
========================= */
.timeline-text {
    width: 45%;
    text-align: right;
}

.timeline-item:nth-child(even) .timeline-text {
    text-align: left;
}

.timeline-text-content {
    background: #fff;
    padding: 25px;
    border-radius: 14px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.timeline-text-content:hover {
    transform: translateY(-5px);
}

/* AÑO con línea amarilla */
.timeline-text-content h3 {
    color: #0d3b66;
    font-size: 1.4rem;
    font-weight: 800;
    position: relative;
    display: inline-block;
    padding-bottom: 8px;
    margin-bottom: 10px;
}

.timeline-text-content h3::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;   /* 🔥 ahora es completa */
    height: 3px;
    background: #fcbf49;
    border-radius: 5px;
}

.timeline-text-content p {
    font-size: 0.95rem;
    color: #666;
    line-height: 1.6;
}

/* =========================
   IMAGENES
========================= */
.timeline-img {
    width: 45%;
    background: #fff;
    padding: 10px;
    border-radius: 18px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    transition: 0.3s ease;

    display: flex;
    justify-content: center;
    align-items: center;
}

/* imagen completa */
.timeline-img img {
    width: 100%;
    height: auto;
    object-fit: contain;
    border-radius: 14px;
    transition: 0.4s ease;
}

/* hover */
.timeline-img:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(0,0,0,0.18);
}

.timeline-img:hover img {
    transform: scale(1.03);
}



/* =========================
   RESPONSIVE
========================= */
@media (max-width: 768px) {

    /* 📏 elimina zigzag en móvil */
    .timeline-item {
        flex-direction: column !important;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 35px;
    }

    /* 📍 línea central más a la izquierda */
    .timeline::before {
        left: 12px;
    }

    /* 🔵 punto alineado mejor */
    .timeline-item::after {
        left: 12px;
        top: 18px;
        width: 12px;
        height: 12px;
    }

    /* 📦 cajas ocupan todo */
    .timeline-text,
    .timeline-img {
        width: 100%;
    }

    /* 🧠 texto más limpio */
    .timeline-text {
        padding-left: 25px;
        text-align: left !important;
    }

    .timeline-text-content {
        padding: 18px;
    }

    /* 📸 imagen más compacta */
    .timeline-img img {
        height: 180px;
        border-radius: 12px;
    }

    /* ❌ elimina sensación de “zigzag raro” */
    .timeline-item:nth-child(even) {
        flex-direction: column !important;
    }
}

</style>

<!-- ==============================
   SECCIÓN: CABECERA
============================== -->
<div class="section-aviso">
    <h2>Nuestra Historia y Propósito</h2>
    <div class="linea-amarilla"></div>
    <p>Más de 30 años formando generaciones de estudiantes comprometidos con la excelencia, la innovación y los valores humanos.</p>
</div>

<!-- ==============================
   SECCIÓN: MISION Y VISION
============================== -->
<div class="section bg-light" id="mision-vision">
    <div class="sub-title">Propósito Institucional</div>

    <div class="pillars-grid">
        <div class="pillar-card">
            <div class="pillar-img">
                <img src="{{ asset('imagen/imagen4.jpg') }}" alt="Misión">
            </div>
            <h3>Nuestra Misión</h3>
            <p>Somos una institución educativa que brinda a nuestros estudiantes una educación de calidad, con alto nivel académico y formación integral. Promovemos valores, el pensamiento crítico y la pasión por el aprendizaje, formando personas íntegras, responsables y comprometidas con la sociedad.</p>
        </div>

        <div class="pillar-card">
            <div class="pillar-img">
                <img src="{{ asset('imagen/imagen5.jpg') }}" alt="Visión">
            </div>
            <h3>Nuestra Visión</h3>
            <p>Ser una institución educativa líder y competitiva, reconocida por ofrecer una educación integral basada en valores, capaz de responder de manera eficiente a las demandas del mundo actual y formar estudiantes preparados para afrontar los retos del futuro con responsabilidad social.</p>
        </div>
    </div>
</div>

<!-- ==============================
   SECCIÓN: VALORES
============================== -->
<div class="section bg-white" id="valores">
    <div class="sub-title">Principios Rectores</div>
    <h2  class="main-title">Nuestros Valores</h2>
    <div class="values-grid">

    <div class="value-card">
        <div class="value-img">
            <img src="{{ asset('iconos/respeto.png') }}">
        </div>
        <h4>Respeto</h4>
        <p>Valoramos la dignidad de cada persona y promovemos la convivencia armoniosa.</p>
    </div>

    <div class="value-card">
        <div class="value-img">
            <img src="{{ asset('iconos/responsabilidad.png') }}">
        </div>
        <h4>Responsabilidad</h4>
        <p>Fomentamos el compromiso con las tareas y el cumplimiento de deberes.</p>
    </div>

    <div class="value-card">
        <div class="value-img">
            <img src="{{ asset('iconos/honestidad.png') }}">
        </div>
        <h4>Honestidad</h4>
        <p>Cultivamos la transparencia y la integridad en todas nuestras acciones.</p>
    </div>

    <div class="value-card">
        <div class="value-img">
            <img src="{{ asset('iconos/solidaridad.png') }}">
        </div>
        <h4>Solidaridad</h4>
        <p>Promovemos el apoyo mutuo y la colaboración en nuestra comunidad.</p>
    </div>

</div>
</div>

<!-- ==============================
   SECCIÓN: HISTORIA
============================== -->
<div class="section timeline-section" id="historia">
    <div style="text-align:center; margin-bottom: 40px;">
    <span style="color: #0d3b66; font-weight: bold; letter-spacing: 2px;">
        Nuestra Trayectoria
    </span>
    <h2 style="color:#0d3b66; font-size: 2.5rem; margin-top: 10px;">
        Un Legado de Excelencia
    </h2>
</div>

<!-- TIMELINE -->
<div class="timeline">

    <!-- ITEM 1 -->
    <div class="timeline-item">
        <div class="timeline-text">
            <div class="timeline-text-content">
                <h3>2006</h3>
                <p>Se funda el colegio Nuestra Señora del Rosario en el distrito de Pillco Marca. Inicia sus actividades con la Resolución Directoral N.° 01151, con el objetivo de brindar una educación de calidad y formar estudiantes de manera integral.</p>
            </div>
        </div>

        <div class="timeline-img">
            <img src="{{ asset('imagen/historia1.jpg') }}">
        </div>
    </div>

    <!-- ITEM 2 -->
    <div class="timeline-item">
        <div class="timeline-text">
            <div class="timeline-text-content">
                <h3>2007 – 2012</h3>
                <p>Durante estos años, el colegio comienza a implementar el enfoque por competencias, desarrollando proyectos educativos innovadores. Se enfoca en mejorar la enseñanza y en formar estudiantes con habilidades y conocimientos sólidos.</p>
            </div>
        </div>

        <div class="timeline-img">
            <img src="{{ asset('imagen/historia2.jpg') }}">
        </div>
    </div>

    <!-- ITEM 3 -->
    <div class="timeline-item">
        <div class="timeline-text">
            <div class="timeline-text-content">
                <h3>2013 – 2019</h3>
                <p>En esta etapa, la institución se consolida en la región, fortaleciendo la formación en valores con un enfoque bíblico práctico. Además, se orienta a los estudiantes hacia el ingreso directo a la universidad, logrando mayor reconocimiento en Huánuco.</p>
            </div>
        </div>

        <div class="timeline-img">
            <img src="{{ asset('imagen/historia3.jpg') }}">
        </div>
    </div>

    <!-- ITEM 4 -->
    <div class="timeline-item">
        <div class="timeline-text">
            <div class="timeline-text-content">
                <h3>2020 – Actualidad</h3>
                <p>Actualmente, el colegio se adapta a los cambios educativos, incorporando herramientas tecnológicas y manteniendo su compromiso con la excelencia académica. Continúa formando estudiantes con valores y proyectándose como un referente en la educación huanuqueña</p>
            </div>
        </div>

        <div class="timeline-img">
            <img src="{{ asset('imagen/historia4.jpg') }}">
        </div>
    </div>

</div>

</div>
@endsection