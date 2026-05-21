@extends('layouts.admin')

@section('titulo', 'Imágenes de Programas')

@section('contenido')

{{-- ── FORMS ELIMINAR FUERA (evita anidación) ── --}}
@php
    $programas = [
        'inicial'        => ['label' => 'Inicial',        'icon' => 'fa-child',          'color' => '#6366f1'],
        'primaria'       => ['label' => 'Primaria',       'icon' => 'fa-book-open',      'color' => '#f59e0b'],
        'secundaria'     => ['label' => 'Secundaria',     'icon' => 'fa-graduation-cap', 'color' => '#10b981'],
        'psicopedagogia' => ['label' => 'Psicopedagogía', 'icon' => 'fa-brain',          'color' => '#ec4899'],
    ];
@endphp

@foreach($programas as $key => $info)
<form id="form-delete-{{ $key }}"
      action="{{ route('admin.imagenes.destroy', $key) }}"
      method="POST" style="display:none;">
    @csrf
</form>
@endforeach

{{-- ── MENSAJES FLASH ── --}}
@if(session('success'))
    <div style="background:rgba(34,197,94,0.15); color:#22c55e; border:1px solid rgba(34,197,94,0.3); padding:14px 18px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:10px;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background:rgba(248,113,113,0.15); color:#f87171; border:1px solid rgba(248,113,113,0.3); padding:14px 18px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:10px;">
        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
    </div>
@endif

{{-- ── CABECERA ── --}}
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; gap:20px; flex-wrap:wrap;">
    <div>
        <h1 style="margin:0; color:#fff; font-size:2rem; font-weight:800;">Imágenes de Programas</h1>
        <p style="margin:5px 0 0; color:var(--text-muted);">Administra las fotos que aparecen en la página de programas académicos.</p>
    </div>
</div>

{{-- ── GRID DE PROGRAMAS ── --}}
<div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(280px,1fr)); gap:24px;">
    @foreach($programas as $key => $info)
    @php $img = $imagenes[$key] ?? null; @endphp
    
    <div style="background:var(--card-bg); border:1px solid var(--border-color); border-radius:20px; overflow:hidden;">

        {{-- Imagen actual --}}
        <div style="position:relative; height:200px; background:rgba(0,0,0,0.3);">
            @if($img && $img->imagen)
                <img src="{{ $img->imagen }}"
                     style="width:100%; height:100%; object-fit:cover; display:block;">
            @else
                <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:10px; color:var(--text-muted);">
                    <i class="fa-solid fa-image-slash" style="font-size:2.5rem; opacity:0.3;"></i>
                    <span style="font-size:0.82rem;">Sin imagen</span>
                </div>
            @endif

            {{-- Badge --}}
            <div style="position:absolute; top:14px; left:14px; background:{{ $info['color'] }}; color:#fff; padding:6px 14px; border-radius:8px; font-size:0.72rem; font-weight:800; text-transform:uppercase; letter-spacing:1px; display:flex; align-items:center; gap:7px;">
                <i class="fa-solid {{ $info['icon'] }}"></i> {{ $info['label'] }}
            </div>

            {{-- Botón eliminar sobre la imagen --}}
            @if($img && $img->imagen)
            <button type="button"
                onclick="if(confirm('¿Eliminar imagen de {{ $info['label'] }}?')) document.getElementById('form-delete-{{ $key }}').submit()"
                style="position:absolute; top:14px; right:14px; background:rgba(239,68,68,0.9); color:#fff; border:none; border-radius:8px; width:34px; height:34px; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:0.85rem;"
                title="Eliminar imagen">
                <i class="fa-solid fa-trash-can"></i>
            </button>
            @endif
        </div>

        {{-- Formulario cambiar imagen --}}
        <div style="padding:20px;">
            <form action="{{ route('admin.imagenes.update', $key) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div id="drop-{{ $key }}"
                     style="border:2px dashed var(--border-color); padding:20px; border-radius:12px; text-align:center; cursor:pointer; transition:0.3s; background:rgba(0,0,0,0.1); margin-bottom:14px;"
                     onclick="document.getElementById('file-{{ $key }}').click()">
                    <input type="file" name="imagen" id="file-{{ $key }}" accept="image/*"
                           style="display:none;" onchange="previewImg(this, '{{ $key }}')">
                    <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.5rem; color:var(--primary); display:block; margin-bottom:8px;"></i>
                    <span id="label-{{ $key }}" style="color:var(--text-muted); font-size:0.82rem;">
                        {{ $img ? 'Cambiar imagen' : 'Subir imagen' }}
                    </span>
                </div>

                <button type="submit"
                    style="width:100%; background:var(--primary); color:#fff; padding:12px; border:none; border-radius:12px; font-weight:700; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; transition:opacity 0.2s;"
                    onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                    <i class="fa-solid fa-floppy-disk"></i> {{ $img ? 'Actualizar' : 'Guardar' }}
                </button>
            </form>
        </div>

    </div>
    @endforeach
</div>

<script>
function previewImg(input, key) {
    const label = document.getElementById('label-' + key);
    const zone  = document.getElementById('drop-' + key);
    if (input.files && input.files[0]) {
        label.textContent      = input.files[0].name;
        label.style.color      = 'var(--accent)';
        zone.style.borderColor = 'var(--accent)';
        zone.style.background  = 'rgba(251,191,36,0.05)';
    }
}
</script>

@endsection