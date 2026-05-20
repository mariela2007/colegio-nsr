@extends('layouts.admin')

@section('titulo', 'Mensajes de Contacto')

@section('contenido')

{{-- ── MENSAJES FLASH ── --}}
@if(session('success'))
    <div style="background:rgba(34,197,94,0.15); color:#22c55e; border:1px solid rgba(34,197,94,0.3); padding:14px 18px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:10px;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

{{-- ── CABECERA ── --}}
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; gap:20px; flex-wrap:wrap;">
    <div>
        <h1 style="margin:0; color:#fff; font-size:2rem; font-weight:800;">Mensajes de Contacto</h1>
        <p style="margin:5px 0 0; color:var(--text-muted);">Mensajes enviados desde el formulario de contacto.</p>
    </div>
    <div style="background:rgba(99,102,241,0.1); padding:10px 20px; border-radius:50px; border:1px solid var(--border-color);">
        <i class="fa-solid fa-envelope" style="color:var(--accent); margin-right:8px;"></i>
        <span style="color:#fff; font-weight:600;">{{ $contactos->count() }} mensajes</span>
    </div>
</div>

{{-- ── LISTADO ── --}}
<div style="display:grid; gap:16px;">
    @forelse($contactos as $contacto)
    <div style="background:var(--card-bg); border:1px solid {{ $contacto->leido ? 'var(--border-color)' : 'rgba(99,102,241,0.4)' }}; border-radius:16px; overflow:hidden;">

        {{-- Barra superior --}}
        <div style="padding:16px 22px; border-bottom:1px solid var(--border-color); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
            <div style="display:flex; align-items:center; gap:12px;">

                {{-- Indicador leído/no leído --}}
                @if(!$contacto->leido)
                    <span style="width:10px; height:10px; border-radius:50%; background:var(--primary); display:inline-block; flex-shrink:0;"></span>
                @endif

                <div>
                    <p style="margin:0; color:#fff; font-weight:700; font-size:1rem;">{{ $contacto->nombre }}</p>
                    <p style="margin:0; color:var(--text-muted); font-size:0.82rem;">
                        {{ $contacto->email }}
                        @if($contacto->telefono)
                            · {{ $contacto->telefono }}
                        @endif
                    </p>
                </div>
            </div>

            <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                @if($contacto->asunto)
                <span style="background:rgba(251,191,36,0.1); color:var(--accent); border:1px solid rgba(251,191,36,0.2); padding:4px 12px; border-radius:20px; font-size:0.78rem; font-weight:700;">
                    {{ $contacto->asunto }}
                </span>
                @endif

                <span style="color:var(--text-muted); font-size:0.78rem;">
                    <i class="fa-solid fa-clock" style="margin-right:4px;"></i>
                    {{ $contacto->created_at->diffForHumans() }}
                </span>

                {{-- Marcar leído --}}
                @if(!$contacto->leido)
                <form action="{{ route('admin.contactos.leido', $contacto->id) }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit"
                        style="padding:6px 14px; background:rgba(99,102,241,0.15); color:var(--primary); border:1px solid rgba(99,102,241,0.3); border-radius:8px; cursor:pointer; font-size:0.78rem; font-weight:700; transition:0.2s;"
                        onmouseover="this.style.background='rgba(99,102,241,0.3)'" onmouseout="this.style.background='rgba(99,102,241,0.15)'"
                        title="Marcar como leído">
                        <i class="fa-solid fa-check"></i> Leído
                    </button>
                </form>
                @else
                <span style="color:var(--text-muted); font-size:0.78rem;">
                    <i class="fa-solid fa-check-double"></i> Leído
                </span>
                @endif

                {{-- Eliminar --}}
                <form action="{{ route('admin.contactos.destroy', $contacto->id) }}" method="POST"
                      onsubmit="return confirm('¿Eliminar este mensaje?')" style="margin:0;">
                    @csrf
                    <button type="submit"
                        style="width:32px; height:32px; display:flex; align-items:center; justify-content:center; background:rgba(248,113,113,0.1); color:#f87171; border:1px solid rgba(248,113,113,0.2); border-radius:8px; cursor:pointer; transition:0.2s;"
                        onmouseover="this.style.background='rgba(248,113,113,0.25)'" onmouseout="this.style.background='rgba(248,113,113,0.1)'"
                        title="Eliminar">
                        <i class="fa-solid fa-trash-can" style="font-size:0.8rem;"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- Mensaje --}}
        <div style="padding:16px 22px;">
            <p style="margin:0; color:var(--text-muted); font-size:0.92rem; line-height:1.6;">
                {{ $contacto->mensaje }}
            </p>
        </div>

    </div>
    @empty
    <div style="text-align:center; padding:60px 20px; color:var(--text-muted);">
        <i class="fa-solid fa-envelope-open" style="font-size:3rem; margin-bottom:16px; display:block;"></i>
        <p style="font-size:1.1rem;">No hay mensajes aún.</p>
    </div>
    @endforelse
</div>

@endsection