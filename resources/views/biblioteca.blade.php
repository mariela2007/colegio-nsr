@extends('layouts.app')

@section('contenido')

<style>
* { box-sizing: border-box; }
body { margin: 0; background: #f0f4f8; }
.container { max-width: 100% !important; padding: 0 !important; }
.contenido { padding: 0 !important; margin: 0 !important; }

:root {
    --c-blue:   #0d3b66;
    --c-yellow: #ffca28;
    --c-red:    #d62828;
    --c-light:  #f5f0e8;
}

/* ══════════════════════════════
   CABECERA
══════════════════════════════ */
.section-aviso {
    padding: 60px 10% 40px;
    background: var(--c-blue);
    color: #fff;
    text-align: center;
}
.section-aviso h2 {
    font-size: 2.5rem;
    margin: 0 0 10px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 900;
}
.section-aviso p {
    font-size: 1.15rem;
    max-width: 650px;
    margin: 0 auto;
    opacity: 0.9;
    line-height: 1.6;
}
.linea-amarilla {
    width: 80px; height: 5px;
    background: var(--c-yellow);
    margin: 18px auto;
    border-radius: 3px;
}
.tabs {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-bottom: 30px;
}
.tab-btn {
    padding: 10px 28px;
    border: none;
    border-radius: 25px;
    background: rgba(255,255,255,0.15);
    color: #fff;
    cursor: pointer;
    font-weight: 700;
    font-size: 0.95rem;
    transition: 0.3s;
}
.tab-btn.active  { background: var(--c-yellow); color: #003049; }
.tab-btn:hover   { transform: translateY(-2px); }

/* ══════════════════════════════
   TAB CONTENT
══════════════════════════════ */
.tab-content        { display: none; }
.tab-content.active { display: block; }

/* ══════════════════════════════
   SECCIÓN GENERAL
══════════════════════════════ */
.seccion-wrap {
    padding: 50px 8%;
    background: #edf2f7;    
}
.seccion-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 3px solid var(--c-blue);
    padding-bottom: 14px;
    margin-bottom: 40px;
}
.seccion-header h2 {
    font-family: 'Montserrat', sans-serif;
    font-size: 2rem;
    font-weight: 900;
    color: var(--c-blue);
    margin: 0;
}
.seccion-header span {
    font-size: 0.72rem;
    font-weight: 700;
    color: var(--c-red);
    letter-spacing: 2px;
    text-transform: uppercase;
}

/* ══════════════════════════════
   ACTIVIDADES — TARJETAS MES
══════════════════════════════ */
.meses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 28px;
}
.mes-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.09);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
}
.mes-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.14);
}
.card-carrusel {
    position: relative;
    width: 100%; height: 220px;
    overflow: hidden;
    background: linear-gradient(135deg, #1a2a4a, #0d3b66);
    flex-shrink: 0;
}
.card-carrusel img {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity 0.7s ease;
}
.card-carrusel img.activo { opacity: 1; z-index: 2; }
.card-dots {
    position: absolute;
    bottom: 10px; left: 50%;
    transform: translateX(-50%);
    display: flex; gap: 6px; z-index: 10;
}
.card-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: rgba(255,255,255,0.4);
    transition: background 0.3s; cursor: pointer;
}
.card-dot.activo { background: var(--c-yellow); }
.card-arrow {
    position: absolute;
    top: 50%; transform: translateY(-50%);
    z-index: 10;
    background: rgba(0,0,0,0.35); color: #fff;
    border: none; width: 32px; height: 32px;
    border-radius: 50%; cursor: pointer;
    font-size: 0.85rem;
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s, background 0.2s;
}
.mes-card:hover .card-arrow { opacity: 1; }
.card-arrow:hover { background: rgba(0,0,0,0.6); }
.card-arrow.prev { left: 10px; }
.card-arrow.next { right: 10px; }
.card-mes-badge {
    position: absolute; top: 14px; left: 14px; z-index: 10;
    background: var(--c-yellow); color: #003049;
    font-size: 0.7rem; font-weight: 900;
    letter-spacing: 2px; text-transform: uppercase;
    padding: 6px 13px; border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}
.card-foto-count {
    position: absolute; top: 14px; right: 14px; z-index: 10;
    background: rgba(0,0,0,0.45); color: #fff;
    font-size: 0.72rem; font-weight: 700;
    padding: 5px 10px; border-radius: 20px;
    display: flex; align-items: center; gap: 5px;
}
.sin-imagen-label {
    position: absolute; top: 50%; left: 50%;
    transform: translate(-50%,-50%);
    color: rgba(255,255,255,0.2); font-size: 3.5rem;
}
.card-body {
    padding: 20px 22px 24px;
    display: flex; flex-direction: column; gap: 10px; flex: 1;
}
.card-divider { width: 40px; height: 3px; background: var(--c-yellow); border-radius: 2px; }
.card-titulo {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.1rem; font-weight: 800;
    color: var(--c-blue); line-height: 1.3; margin: 0;
}
.card-desc { font-size: 0.98rem; color: #666; line-height: 1.55; margin: 0; }
.card-thumbs { display: flex; gap: 8px; margin-top: 4px; }
.card-thumb {
    width: 52px; height: 52px; border-radius: 10px;
    overflow: hidden; border: 2px solid #eee; cursor: pointer;
    transition: border-color 0.2s, transform 0.2s; flex-shrink: 0;
}
.card-thumb:hover  { border-color: var(--c-yellow); transform: scale(1.05); }
.card-thumb.activo { border-color: var(--c-blue); }
.card-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }

/* ══════════════════════════════
   NOTICIAS — GRID
══════════════════════════════ */
.noticias-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
}
.noticia-card {
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 6px 24px rgba(0,0,0,0.08);
    cursor: pointer;
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
}
.noticia-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.14);
}
.noticia-img-wrap {
    position: relative;
    width: 100%; height: 200px;
    overflow: hidden;
    flex-shrink: 0;
}
.noticia-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
    display: block;
}
.noticia-card:hover .noticia-img-wrap img { transform: scale(1.06); }
.noticia-overlay {
    position: absolute;
    inset: 0;
    background: rgba(13,59,102,0.55);
    display: flex; align-items: center; justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}
.noticia-card:hover .noticia-overlay { opacity: 1; }
.noticia-overlay span {
    color: #fff; font-weight: 700; font-size: 0.9rem;
    border: 2px solid #fff; padding: 8px 20px; border-radius: 25px;
    letter-spacing: 1px;
}
.noticia-badge {
    position: absolute; top: 14px; left: 14px;
    background: var(--c-red); color: #fff;
    font-size: 0.65rem; font-weight: 800;
    letter-spacing: 2px; text-transform: uppercase;
    padding: 5px 11px; border-radius: 6px;
}
.noticia-body {
    padding: 18px 20px 22px;
    display: flex; flex-direction: column; gap: 8px; flex: 1;
}
.noticia-divider { width: 35px; height: 3px; background: var(--c-yellow); border-radius: 2px; }
.noticia-titulo {
    font-family: 'Montserrat', sans-serif;
    font-size: 1rem; font-weight: 800;
    color: var(--c-blue); line-height: 1.35; margin: 0;
}
.noticia-desc {
    font-size: 0.87rem; color: #777;
    line-height: 1.55; margin: 0;
}
.noticia-leer {
    margin-top: auto;
    font-size: 0.82rem; font-weight: 700;
    color: var(--c-blue);
    display: flex; align-items: center; gap: 6px;
    padding-top: 10px;
    border-top: 1px solid #f0f0f0;
}
.noticia-leer i { color: var(--c-yellow); }

/* ══════════════════════════════
   MODAL — SOLO IMAGEN
══════════════════════════════ */
.modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.85);
    z-index: 9998;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    backdrop-filter: blur(6px);
}
.modal-backdrop.abierto { display: flex; }

.modal-box {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: modalEntra 0.3s ease;
}
@keyframes modalEntra {
    from { transform: scale(0.92) translateY(20px); opacity: 0; }
    to   { transform: scale(1) translateY(0); opacity: 1; }
}

.modal-img {
    display: block;
    max-width: 90vw;
    max-height: 90vh;
    width: auto;
    height: auto;
    object-fit: contain;
    border-radius: 16px;
    box-shadow: 0 30px 80px rgba(0,0,0,0.5);
}

.modal-cerrar {
    position: fixed;
    top: 20px; right: 20px;
    background: rgba(0,0,0,0.6);
    color: #fff; border: none;
    width: 42px; height: 42px;
    border-radius: 50%; cursor: pointer;
    font-size: 1.1rem;
    display: flex; align-items: center; justify-content: center;
    transition: background 0.2s;
    z-index: 9999;
}
.modal-cerrar:hover { background: rgba(0,0,0,0.95); }

/* ══════════════════════════════
   EMPTY STATE
══════════════════════════════ */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px; color: #aaa;
}
.empty-state i { font-size: 3.5rem; margin-bottom: 16px; display: block; }
.empty-state p { font-size: 1.1rem; }

/* ══════════════════════════════
   RESPONSIVE
══════════════════════════════ */
@media (max-width: 700px) {
    .meses-grid, .noticias-grid { grid-template-columns: 1fr; }
    .seccion-wrap { padding: 40px 5%; }
}
</style>

<!-- ══ CABECERA ══ -->
<div class="section-aviso">
    <h2>Vida Institucional</h2>
    <div class="tabs">
        <button class="tab-btn active" onclick="mostrarTab('actividades', event)">Actividades</button>
        <button class="tab-btn" onclick="mostrarTab('noticias', event)">Noticias</button>
    </div>
    <div class="linea-amarilla"></div>
    <p>Espacio donde compartimos las actividades, celebraciones y acontecimientos más importantes de nuestra comunidad educativa.</p>
</div>

<!-- ══ ACTIVIDADES ══ -->
<div id="actividades" class="tab-content active">
<div class="seccion-wrap">
    <div class="seccion-header">
        <h2>Actividades del Año</h2>
        <span>{{ isset($eventos) ? $eventos->count() : 0 }} eventos</span>
    </div>
    <div class="meses-grid">
        @forelse($eventos ?? [] as $evento)
        @php $imgs = $evento->imagenes ?? collect(); @endphp
        <div class="mes-card">
            <div class="card-carrusel" id="carrusel-{{ $evento->id }}">
                @if($imgs->isNotEmpty())
                    @foreach($imgs as $img)
                        <img src="{{ $img->imagen }}"
                             class="{{ $loop->first ? 'activo' : '' }}"
                             alt="{{ $evento->titulo }}">
                    @endforeach
                    <div class="card-mes-badge">{{ $evento->mes }}</div>
                    <div class="card-foto-count">
                        <i class="fa-solid fa-camera"></i>
                        <span class="foto-actual">1</span>/{{ $imgs->count() }}
                    </div>
                    @if($imgs->count() > 1)
                    <button class="card-arrow prev" onclick="moverCarrusel({{ $evento->id }}, -1)">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="card-arrow next" onclick="moverCarrusel({{ $evento->id }}, 1)">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                    <div class="card-dots">
                        @foreach($imgs as $img)
                        <div class="card-dot {{ $loop->first ? 'activo' : '' }}"
                             onclick="irAFoto({{ $evento->id }}, {{ $loop->index }})"></div>
                        @endforeach
                    </div>
                    @endif
                @else
                    <div class="card-mes-badge">{{ $evento->mes }}</div>
                    <div class="sin-imagen-label"><i class="fa-solid fa-calendar-days"></i></div>
                @endif
            </div>
            <div class="card-body">
                <div class="card-divider"></div>
                <p class="card-titulo">{{ $evento->titulo }}</p>
                @if($evento->descripcion)
                <p class="card-desc">{{ Str::limit($evento->descripcion, 100) }}</p>
                @endif
                @if($imgs->count() > 1)
                <div class="card-thumbs">
                    @foreach($imgs as $img)
                    <div class="card-thumb {{ $loop->first ? 'activo' : '' }}"
                         onclick="irAFoto({{ $evento->id }}, {{ $loop->index }})">
                        <img src="{{ asset('meses/' . $img->imagen) }}" alt="">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-calendar-xmark"></i>
            <p>No hay actividades registradas aún.</p>
        </div>
        @endforelse
    </div>
</div>
</div>

<!-- ══ NOTICIAS ══ -->
<div id="noticias" class="tab-content">
<div class="seccion-wrap">
    <div class="seccion-header">
        <h2> Noticias y Comunicados</h2>
        <span>{{ isset($noticias) ? $noticias->count() : 0 }} publicaciones</span>
    </div>
    <div class="noticias-grid">
        @forelse($noticias ?? [] as $noticia)
        <div class="noticia-card"
             onclick="abrirModal('{{ $noticia->imagen }}', '{{ addslashes($noticia->titulo) }}')">
            <div class="noticia-img-wrap">
                <img src="{{ $noticia->imagen }}" alt="{{ $noticia->titulo }}">
                <div class="noticia-badge">Comunicado</div>
                <div class="noticia-overlay">
                    <span><i class="fa-solid fa-eye"></i> &nbsp;Ver más</span>
                </div>
            </div>
            <div class="noticia-body">
                <div class="noticia-divider"></div>
                <p class="noticia-titulo">{{ $noticia->titulo }}</p>
                <p class="noticia-desc">{{ Str::limit($noticia->descripcion, 90) }}</p>
                <div class="noticia-leer">
                    <i class="fa-solid fa-arrow-right"></i> Ver comunicado completo
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-newspaper"></i>
            <p>No hay noticias registradas aún.</p>
        </div>
        @endforelse
    </div>
</div>
</div>

<!-- ══ MODAL — SOLO IMAGEN ══ -->
<div class="modal-backdrop" id="modalBackdrop" onclick="cerrarModalFuera(event)">
    <button class="modal-cerrar" onclick="cerrarModal()">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <div class="modal-box" id="modalBox">
        <img id="modalImg" src="" alt="" class="modal-img">
    </div>
</div>

<script>
/* ══ CARRUSEL ACTIVIDADES ══ */
const estados = {};

function initCarrusel(id, total) { estados[id] = { index: 0, total }; }

function moverCarrusel(id, dir) {
    if (!estados[id]) return;
    estados[id].index = (estados[id].index + dir + estados[id].total) % estados[id].total;
    aplicarEstado(id);
}

function irAFoto(id, index) {
    if (!estados[id]) return;
    estados[id].index = index;
    aplicarEstado(id);
}

function aplicarEstado(id) {
    const wrap    = document.getElementById('carrusel-' + id);
    if (!wrap) return;
    const card    = wrap.closest('.mes-card');
    const imgs    = wrap.querySelectorAll('img');
    const dots    = wrap.querySelectorAll('.card-dot');
    const thumbs  = card ? card.querySelectorAll('.card-thumb') : [];
    const counter = wrap.querySelector('.foto-actual');
    const idx     = estados[id].index;

    imgs.forEach((img, i)   => img.classList.toggle('activo', i === idx));
    dots.forEach((dot, i)   => dot.classList.toggle('activo', i === idx));
    thumbs.forEach((t, i)   => t.classList.toggle('activo', i === idx));
    if (counter) counter.textContent = idx + 1;
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.card-carrusel').forEach(wrap => {
        const id   = parseInt(wrap.id.replace('carrusel-', ''));
        const imgs = wrap.querySelectorAll('img');
        if (imgs.length === 0) return;
        initCarrusel(id, imgs.length);
        if (imgs.length > 1) {
            setInterval(() => moverCarrusel(id, 1), 3500);
        }
    });
});

/* ══ MODAL — SOLO IMAGEN ══ */
function abrirModal(img, alt) {
    document.getElementById('modalImg').src = img;
    document.getElementById('modalImg').alt = alt;
    document.getElementById('modalBackdrop').classList.add('abierto');
    document.body.style.overflow = 'hidden';
}

function cerrarModal() {
    document.getElementById('modalBackdrop').classList.remove('abierto');
    document.body.style.overflow = '';
}

function cerrarModalFuera(e) {
    if (e.target === document.getElementById('modalBackdrop')) cerrarModal();
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') cerrarModal();
});

/* ══ TABS ══ */
function mostrarTab(tab, event) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.getElementById(tab).classList.add('active');
    event.currentTarget.classList.add('active');
}
</script>

@endsection