@if ($paginator->hasPages())
    <nav aria-label="Paginación">
        <ul class="pagination justify-content-center mb-0">
            {{-- Botón Anterior --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Anterior</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Anterior</a>
                </li>
            @endif

            {{-- Números de página --}}
            @foreach ($elements as $element)
                {{-- Separador "..." --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array de Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Botón Siguiente --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Siguiente</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Siguiente</span>
                </li>
            @endif
        </ul>
    </nav>

    {{-- Información de registros --}}
    <div class="text-center mt-2">
        <small class="text-muted">
            Mostrando {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} de {{ $paginator->total() }} registros
        </small>
    </div>
@endif