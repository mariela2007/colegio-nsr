@extends('layouts.admin')
 
@section('titulo', 'Gestión de Eventos')
 
@section('contenido')
 
{{-- ── MENSAJES FLASH ── --}}
@if(session('error'))
    <div style="background:rgba(248,113,113,0.15); color:#f87171; border:1px solid rgba(248,113,113,0.3); padding:14px 18px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:10px;">
        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
    </div>
@endif
 
@if(session('success'))
    <div style="background:rgba(34,197,94,0.15); color:#22c55e; border:1px solid rgba(34,197,94,0.3); padding:14px 18px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:10px;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif
 
{{-- ── CABECERA ── --}}
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; gap:20px; flex-wrap:wrap;">
    <div>
        <h1 style="margin:0; color:#fff; font-size:2rem; font-weight:800;">Agenda de Eventos</h1>
        <p style="margin:5px 0 0; color:var(--text-muted);">Organiza las actividades mensuales y sus galerías fotográficas.</p>
    </div>
    <div style="background:rgba(99,102,241,0.1); padding:10px 20px; border-radius:50px; border:1px solid var(--border-color);">
        <i class="fa-solid fa-calendar-days" style="color:var(--accent); margin-right:8px;"></i>
        <span style="color:#fff; font-weight:600;">{{ count($eventos) }} Eventos registrados</span>
    </div>
</div>
 
{{-- ── FORMULARIO CREAR ── --}}
<section style="background:var(--card-bg); backdrop-filter:blur(10px); padding:30px; border-radius:24px; border:1px solid var(--border-color); margin-bottom:40px;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:25px;">
        <i class="fa-solid fa-circle-plus" style="color:var(--primary); font-size:1.2rem;"></i>
        <h2 style="margin:0; color:#fff; font-size:1.4rem;">Nuevo Registro</h2>
    </div>
 
    <form action="{{ route('admin.eventos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px,1fr)); gap:20px; margin-bottom:20px;">

            {{-- ✅ MES: select fijo --}}
            <div>
                <label style="color:var(--text-muted); display:block; margin-bottom:8px; font-size:0.9rem;">Mes</label>
                <select name="mes"
                    style="width:100%; padding:14px; background:rgba(15,23,42,0.5); border:1px solid var(--border-color); border-radius:12px; color:#fff; outline:none; cursor:pointer;"
                    onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border-color)'"
                    oninvalid="this.setCustomValidity('⚠️ Debes seleccionar un mes')"
                    oninput="this.setCustomValidity('')"
                    required>
                    <option value="" disabled selected style="color:#6b7280;">-- Seleccionar mes --</option>
                    @foreach(['Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'] as $m)
                        <option value="{{ $m }}" style="background:#1e293b; color:#fff;" {{ old('mes') === $m ? 'selected' : '' }}>
                            {{ $m }}
                        </option>
                    @endforeach
                </select>
                @error('mes') <p style="color:#f87171; font-size:0.85rem; margin-top:6px;">{{ $message }}</p> @enderror
            </div>

            {{-- TÍTULO --}}
            <div>
                <label style="color:var(--text-muted); display:block; margin-bottom:8px; font-size:0.9rem;">Título del Evento</label>
                <input type="text" name="titulo" value="{{ old('titulo') }}" placeholder="Ej: Día del Estudiante"
                    style="width:100%; padding:14px; background:rgba(15,23,42,0.5); border:1px solid var(--border-color); border-radius:12px; color:#fff; outline:none;"
                    onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border-color)'"
                    oninvalid="this.setCustomValidity('⚠️ Debes escribir el título del evento')"
                    oninput="this.setCustomValidity('')"
                    required>
                @error('titulo') <p style="color:#f87171; font-size:0.85rem; margin-top:6px;">{{ $message }}</p> @enderror
            </div>
        </div>
 
        {{-- ✅ DESCRIPCIÓN: required --}}
        <div style="margin-bottom:20px;">
            <label style="color:var(--text-muted); display:block; margin-bottom:8px; font-size:0.9rem;">Descripción</label>
            <textarea name="descripcion" rows="2" placeholder="Breve resumen de la actividad..." required
                style="width:100%; padding:14px; background:rgba(15,23,42,0.5); border:1px solid var(--border-color); border-radius:12px; color:#fff; outline:none; resize:vertical;"
                onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border-color)'"
                oninvalid="this.setCustomValidity('⚠️ Debes escribir una descripción del evento')"
                oninput="this.setCustomValidity('')">{{ old('descripcion') }}</textarea>
            @error('descripcion') <p style="color:#f87171; font-size:0.85rem; margin-top:6px;">{{ $message }}</p> @enderror
        </div>
 
        <div style="margin-bottom:25px;">
            <label style="color:var(--text-muted); display:block; margin-bottom:8px; font-size:0.9rem;">
                Galería de Fotos <span style="font-size:0.8rem;">(máximo 3)</span>
            </label>
            <div id="drop-zone"
                 style="border:2px dashed var(--border-color); padding:30px; border-radius:15px; text-align:center; transition:0.3s; background:rgba(0,0,0,0.1); cursor:pointer;"
                 onclick="document.getElementById('input-imgs').click()">
                <input type="file" name="imagenes[]" multiple accept="image/*" id="input-imgs"
                       style="display:none;" onchange="handleFiles(this)">
                <i class="fa-solid fa-cloud-arrow-up" style="font-size:2rem; color:var(--primary); display:block; margin-bottom:10px;"></i>
                <span id="file-count" style="color:#fff; font-weight:700;">Seleccionar imágenes</span>
                <br>
                <span style="color:var(--text-muted); font-size:0.8rem;">Arrastra o haz clic · JPG, PNG, WEBP · Máx. 4MB</span>
            </div>
        </div>
 
        <button type="submit"
            style="background:var(--primary); color:#fff; padding:14px 30px; border:none; border-radius:12px; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:10px; transition:opacity 0.2s;"
            onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
            <i class="fa-solid fa-floppy-disk"></i> Guardar Evento
        </button>
    </form>
</section>
 
{{-- ✅ ORDENAR POR MES ESCOLAR (Marzo → Diciembre) --}}
@php
    $ordenMeses = ['Marzo'=>1,'Abril'=>2,'Mayo'=>3,'Junio'=>4,'Julio'=>5,'Agosto'=>6,'Septiembre'=>7,'Octubre'=>8,'Noviembre'=>9,'Diciembre'=>10];
    $eventosOrdenados = $eventos->sortBy(fn($e) => $ordenMeses[ucfirst(strtolower($e->mes))] ?? 99);
@endphp

{{-- ── LISTADO ── --}}
<div style="display:grid; gap:20px;">
    @forelse($eventosOrdenados as $evento)
    <div style="background:var(--card-bg); border:1px solid var(--border-color); border-radius:20px; overflow:hidden;">
 
        {{-- Barra superior --}}
        <div style="padding:20px 25px; border-bottom:1px solid var(--border-color); display:flex; justify-content:space-between; align-items:center; background:rgba(255,255,255,0.01); flex-wrap:wrap; gap:12px;">
            <div style="display:flex; align-items:center; gap:15px;">
                <span style="background:var(--accent); color:#000; padding:5px 15px; border-radius:8px; font-weight:800; font-size:0.75rem; text-transform:uppercase; white-space:nowrap;">
                    {{ $evento->mes }}
                </span>
                <h3 style="margin:0; color:#fff; font-size:1.2rem;">{{ $evento->titulo }}</h3>
            </div>
 
            <div style="display:flex; gap:8px;">
                <a href="{{ route('admin.eventos.edit', $evento->id) }}"
                   style="width:38px; height:38px; display:flex; align-items:center; justify-content:center; background:rgba(255,255,255,0.05); color:#fff; border:1px solid var(--border-color); border-radius:10px; text-decoration:none; transition:0.3s;"
                   onmouseover="this.style.background='rgba(255,255,255,0.12)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'"
                   title="Editar Evento">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
 
                <form action="{{ route('admin.eventos.destroy', $evento->id) }}" method="POST"
                      onsubmit="return confirm('¿Eliminar el evento «{{ $evento->titulo }}» y todas sus imágenes?')"
                      style="margin:0;">
                    @csrf
                    <button type="submit"
                        style="width:38px; height:38px; display:flex; align-items:center; justify-content:center; background:rgba(248,113,113,0.1); color:#f87171; border:1px solid rgba(248,113,113,0.2); border-radius:10px; cursor:pointer; transition:0.3s;"
                        onmouseover="this.style.background='rgba(248,113,113,0.25)'" onmouseout="this.style.background='rgba(248,113,113,0.1)'"
                        title="Eliminar Evento">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </div>
        </div>
 
        {{-- Contenido y galería --}}
        <div style="padding:20px 25px;">
            @if($evento->descripcion)
            <p style="margin:0 0 20px 0; color:var(--text-muted); line-height:1.6; font-size:0.95rem;">
                {{ $evento->descripcion }}
            </p>
            @endif
 
            @if($evento->imagenes->isNotEmpty())
            <div style="display:flex; gap:12px; overflow-x:auto; padding-bottom:8px; scrollbar-width:thin;">
                @foreach($evento->imagenes as $img)
                <div style="flex-shrink:0;">
                    <img src="{{ $img->imagen }}"
                         style="width:100px; height:100px; object-fit:cover; border-radius:12px; border:1px solid var(--border-color); display:block;">
                </div>
                @endforeach
            </div>
            @else
            <p style="color:var(--text-muted); font-size:0.85rem; margin:0;">
                <i class="fa-solid fa-image-slash" style="margin-right:6px;"></i> Sin imágenes
            </p>
            @endif
        </div>
    </div>
    @empty
    <div style="text-align:center; padding:60px 20px; color:var(--text-muted);">
        <i class="fa-solid fa-calendar-xmark" style="font-size:3rem; margin-bottom:16px; display:block;"></i>
        <p style="font-size:1.1rem;">No hay eventos registrados aún.</p>
    </div>
    @endforelse
</div>
 
<script>
function handleFiles(input) {
    const text = document.getElementById('file-count');
    const zone = document.getElementById('drop-zone');
 
    if (input.files.length > 0) {
        text.innerText        = input.files.length + ' archivo(s) seleccionado(s)';
        text.style.color      = 'var(--accent)';
        zone.style.borderColor = 'var(--accent)';
        zone.style.background  = 'rgba(251,191,36,0.05)';
    } else {
        text.innerText        = 'Seleccionar imágenes';
        text.style.color      = '#fff';
        zone.style.borderColor = 'var(--border-color)';
        zone.style.background  = 'rgba(0,0,0,0.1)';
    }
}
</script>
 
@endsection