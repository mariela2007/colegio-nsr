@extends('layouts.app')

@section('contenido')

<style>

/* RESET */
*{
    box-sizing: border-box;
}

body {
    margin: 0;
    background: #f4f7fb;
}

.container {
    max-width: 100% !important;
    padding: 0 !important;
}

.contenido {
    padding: 0 !important;
    margin: 0 !important;
    font-family: 'Plus Jakarta San', sans-serif;
}

/* VARIABLES */
:root {
    --c-blue: #0d3b66;
    --c-yellow: #ffca28;
}

/* ==============================
   CABECERA
============================== */
.section-aviso {
    padding: 60px 10%;
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

/* ==============================
   SECCIÓN EVENTOS
============================== */

/* =========================
   SECCIÓN GENERAL
========================= */
/* =========================
   SECCIÓN GENERAL
========================= */
.section {
    padding: 60px 10%;
    background: #f5f0e8;
    font-family: 'Montserrat', sans-serif;
    .sub-title {
    text-transform: uppercase;
    color: var(--c-blue);
    font-weight: 700;
    letter-spacing: 2px;
    font-size: 0.75rem;
    margin-bottom: 29px;
    margin-top: -2px;
}
}

/* =========================
   HEADER EDITORIAL
========================= */
.section-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    border-bottom: 3px solid #003049;
    padding-bottom: 16px;
    margin-bottom: 4px;
}

.section-header h2 {
    font-size: 2.4rem;
    font-weight: 900;
    color: #003049;
    letter-spacing: -1px;
    line-height: 1;
}

.section-header span {
    font-family: sans-serif;
    font-size: 0.7rem;
    font-weight: 700;
    color: #d62828;
    letter-spacing: 2px;
    text-transform: uppercase;
}

/* =========================
   LAYOUTS (IMÁGENES MÁS GRANDES)
========================= */
.layout-top {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 4px;
    margin-bottom: 4px;
    height: 400px; /* 🔥 MÁS GRANDE */
}

.layout-mid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 4px;
    margin-bottom: 4px;
    height: 260px; /* 🔥 MÁS GRANDE */
}

.layout-bot {
     display: grid;
    grid-template-columns: 1fr 2fr; /* 🔥 derecha más grande (diciembre) */
    gap: 4px;
    height: 400px; /* 🔥 mismo tamaño que arriba */
}

/* =========================
   BLOQUE EVENTO
========================= */
.evt {
    position: relative;
    overflow: hidden;
    cursor: pointer;
}

/* =========================
   IMAGEN
========================= */
.evt-img {
    width: 100%;
    height: 100%;
    position: relative;
}

.evt-img img {
    position: absolute;
    top: 0;
    left: 0;

    width: 100%;
    height: 100%;

    object-fit: cover;
    transition: transform 0.5s ease;
}

.evt:hover .evt-img img {
    transform: scale(1.06);
}

/* =========================
   OVERLAY
========================= */
.evt-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;

    padding: 22px;

    background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);
}

/* =========================
   MES (🔥 AHORA ARRIBA COMO ETIQUETA)
========================= */
.evt-mes {
       position: absolute;
    top: 12px;
    left: 12px;

    z-index: 10;

    font-family: sans-serif;
    font-size: 0.75rem;
    font-weight: 900;

    color: #003049;
    background: #fcbf49;

    padding: 7px 12px;

    border-radius: 8px;

    letter-spacing: 2px;
    text-transform: uppercase;

    box-shadow: 0 8px 18px rgba(0,0,0,0.25);

    border: 2px solid rgba(255,255,255,0.3);
}

/* =========================
   NUMERO
========================= */
.evt-numero {
    position: absolute;
    top: 14px;
    right: 16px;

    font-family: sans-serif;
    font-size: 0.75rem;
    font-weight: 800;

    color: rgba(255,255,255,0.25);
    letter-spacing: 1px;
}

/* =========================
   TEXTO (MEJOR PROPORCIÓN)
========================= */
.evt-title {
    font-size: 1.15rem; /* 🔥 MÁS GRANDE */
    font-weight: 700;
    color: #fff;
    line-height: 1.25;
}

.evt-title-lg {
    font-size: 1.7rem; /* 🔥 DESTACADOS */
}

.evt-desc {
    font-family: sans-serif;
    font-size: 1.0rem; /* 🔥 antes muy pequeño */
    color: rgba(255,255,255,0.85);
    margin-top: 6px;
    line-height: 1.4;
}

/* =========================
   CARRUSEL
========================= */
.carrusel-auto img {
    opacity: 0;
    transform: scale(1.12);
    transition: opacity 1s ease, transform 4s ease;
}

.carrusel-auto img.activo {
    opacity: 1;
    transform: scale(1);
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 900px) {
    .layout-top,
    .layout-bot {
        grid-template-columns: 1fr;
        height: auto;
    }

    .layout-mid {
        grid-template-columns: 1fr 1fr;
        height: auto;
    }

    .layout-top .evt,
    .layout-bot .evt {
        height: 280px;
    }

    .layout-mid .evt {
        height: 220px;
    }
}

@media (max-width: 600px) {
    .section {
        padding: 40px 5%;
    }

    .layout-mid {
        grid-template-columns: 1fr;
    }

    .evt-title-lg {
        font-size: 1.3rem;
    }

    .layout-top .evt,
    .layout-bot .evt {
        height: 240px;
    }
}
</style>

<!-- CABECERA -->
<div class="section-aviso">
    <h2>Vida Institucional</h2>
    <div class="linea-amarilla"></div>
    <p>
        Espacio donde compartimos las actividades, celebraciones y acontecimientos más importantes de nuestra comunidad educativa.
    </p>
</div>

<!-- EVENTOS -->
<div class="section">

  <!-- FILA TOP: Marzo + Abril -->
  <div class="layout-top">
    <div class="evt">
      <div class="evt-img carrusel-auto">
        <img src="{{ asset('meses/marzo1.jpg') }}" class="activo">
        <img src="{{ asset('meses/marzo2.jpg') }}">
        <img src="{{ asset('meses/marzo3.jpg') }}">
      </div>
             <div class="evt-mes">Marzo</div>

      <div class="evt-numero">03</div>
      <div class="evt-overlay">
        <div class="evt-title evt-title-lg">Buen Inicio del Año Escolar</div>
        <div class="evt-desc">Bienvenida a todas las estudiantes a un nuevo ciclo de aprendizaje.</div>
      </div>
    </div>
    <div class="evt">
      <div class="evt-img">
        <img src="{{ asset('meses/abril.jpg') }}">
      </div>
              <div class="evt-mes">Abril</div>
      <div class="evt-numero">04</div>
      <div class="evt-overlay">
        <div class="evt-title">Semana Santa</div>
        <div class="evt-desc">Tiempo de reflexión y participación en comunidad.</div>
      </div>
    </div>
  </div>

  <!-- FILA MID 1: Mayo + Junio + Julio -->
  <div class="layout-mid">
    <div class="evt">
      <div class="evt-img">
        <img src="{{ asset('meses/mayo.jpg') }}">
      </div>
              <div class="evt-mes">Mayo</div>
      <div class="evt-numero">05</div>
      <div class="evt-overlay">
        <div class="evt-title">Día de la Madre</div>
      </div>
    </div>
    <div class="evt">
      <div class="evt-img carrusel-auto">
        <img src="{{ asset('meses/junio1.jpg') }}" class="activo">
        <img src="{{ asset('meses/junio2.jpg') }}">
        <img src="{{ asset('meses/junio3.jpg') }}">
      </div>
              <div class="evt-mes">Junio</div>
      <div class="evt-numero">06</div>
      <div class="evt-overlay">
        <div class="evt-title">Día del Padre y del Campesino</div>
      </div>
    </div>
    <div class="evt">
      <div class="evt-img">
        <img src="{{ asset('meses/julio1.jpg') }}">
      </div>
              <div class="evt-mes">Julio</div>
      <div class="evt-numero">07</div>
      <div class="evt-overlay">
        <div class="evt-title">Fiestas Patrias</div>
      </div>
    </div>
  </div>

  <!-- FILA MID 2: Agosto + Septiembre + Octubre -->
  <div class="layout-mid">
    <div class="evt">
      <div class="evt-img">
        <img src="{{ asset('meses/agosto.jpg') }}">
      </div>
              <div class="evt-mes">Agosto</div>
      <div class="evt-numero">08</div>
      <div class="evt-overlay">
        <div class="evt-title">Santa Rosa de Lima</div>
      </div>
    </div>
    <div class="evt">
      <div class="evt-img">
        <img src="{{ asset('meses/septiembre.jpg') }}">
      </div>
              <div class="evt-mes">Septiembre</div>
      <div class="evt-numero">09</div>
      <div class="evt-overlay">
        <div class="evt-title">Día de la Juventud</div>
      </div>
    </div>
    <div class="evt">
      <div class="evt-img">
        <img src="{{ asset('meses/octubre.jpg') }}">
      </div>
              <div class="evt-mes">Octubre</div>
      <div class="evt-numero">10</div>
      <div class="evt-overlay">
        <div class="evt-title">Señor de los Milagros</div>
      </div>
    </div>
  </div>

  <!-- FILA BOT: Noviembre + Diciembre -->
  <div class="layout-bot">
    <div class="evt">
      <div class="evt-img">
        <img src="{{ asset('meses/noviembre.jpg') }}">
      </div>
              <div class="evt-mes">Noviembre</div>
      <div class="evt-numero">11</div>
      <div class="evt-overlay">
        <div class="evt-title">Día de los Santos</div>
        <div class="evt-desc">Recordando a nuestros seres queridos y tradiciones locales.</div>
      </div>
    </div>
    <div class="evt">
  <div class="evt-img carrusel-auto">

    <img src="{{ asset('meses/diciembre1.jpg') }}" class="activo">
    <img src="{{ asset('meses/diciembre2.jpg') }}">
    <img src="{{ asset('meses/diciembre3.jpg') }}">

    <div class="evt-mes">Diciembre</div>
    <div class="evt-numero">12</div>

    <div class="evt-overlay">
      <div class="evt-title evt-title-lg">Clausura y Navidad</div>
      <div class="evt-desc">
        Cierre del año académico y celebración del nacimiento de Jesús.
      </div>
    </div>

  </div>
</div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const carruseles = document.querySelectorAll('.carrusel-auto');

    carruseles.forEach(carrusel => {
        const imgs = carrusel.querySelectorAll('img');
        let index = 0;

        if (imgs.length <= 1) return; // 🔥 evita errores

        setInterval(() => {
            imgs[index].classList.remove('activo');
            index = (index + 1) % imgs.length;
            imgs[index].classList.add('activo');
        }, 3000);
    });

});
</script>
@endsection