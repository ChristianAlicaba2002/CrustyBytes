@if ($paginator->hasPages())
    <nav>
        <ul class="pagination"
            style="display: flex; justify-content: center; align-items: center; gap: 8px; list-style: none; padding: 1rem 0;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li style="opacity: 0.5; pointer-events: none;">
                    <span
                        style="padding: 8px 12px; background-color: #f0f0f0; color: #888; border-radius: 4px;">Previous</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        style="padding: 8px 12px; background-color: white; border: 1px solid #ccc; color: #333; border-radius: 4px; text-decoration: none;">
                        Previous
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Dots --}}
                @if (is_string($element))
                    <li><span style="padding: 8px 12px; color: #999;">{{ $element }}</span></li>
                @endif

                {{-- Page Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span
                                    style="padding: 8px 12px; background-color: orange; color: white; font-weight: bold; border-radius: 4px;">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    style="padding: 8px 12px; background-color: white; border: 1px solid #ccc; color: #333; border-radius: 4px; text-decoration: none;">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        style="padding: 8px 12px; background-color: white; border: 1px solid #ccc; color: #333; border-radius: 4px; text-decoration: none;">
                        Next
                    </a>
                </li>
            @else
                <li style="opacity: 0.5; pointer-events: none;">
                    <span
                        style="padding: 8px 12px; background-color: #f0f0f0; color: #888; border-radius: 4px;">Next</span>
                </li>
            @endif
        </ul>

    </nav>
@endif
