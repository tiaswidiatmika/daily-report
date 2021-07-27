@extends('app')

@section('title')
    <title>Available Templates</title>
@endsection

@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/show-available-templates.css') }}">
@endsection

@section('jsfiles')
    <script src="{{ asset('js/show-available-templates.js') }}" defer></script>
@endsection

@section('content')

    <div class="main-page-container">
        <input type="text" class="search-template-name" name="search-template" id="search-template" placeholder="..search template">
        <!-- template items start here -->
        @if ( $availableTemplates->isNotEmpty() )
            @foreach ( $availableTemplates as $key => $template )
            <span class="template-items-container">
                <a 
                href="{{ route('use-template', [
                    'id' => $template->id,
                    'ref' => $ref
                    ]) }}"
                class="template-items">
                    <svg class="file-icon">
                        <path fill="currentColor" d="M15,7H20.5L15,1.5V7M8,0H16L22,6V18A2,2 0 0,1 20,20H8C6.89,20 6,19.1 6,18V2A2,2 0 0,1 8,0M4,4V22H20V24H4A2,2 0 0,1 2,22V4H4Z" />
                    </svg>
                    <span class="template-name">
                        {{ $key+1 . '. ' . strtoupper( $template->template_name ) }}
                    </span>
                </a>
                
            {{-- action control  --}}
                
                <form action="{{ route('delete-template', [ 'id' => $template->id ]) }}" method="post">
                    @method('delete')
                    @csrf
                    <input type="hidden" name="template_id" value="{{ $template->id }}">
                    <label>
                        <input type="submit" id="delete-btn"/>
                        <svg
                            class="delete danger action-control"
                            aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
                        </svg>
                    </label>
                </form>
                {{-- <a class="action-control" href="{{ route('delete-template') }}">
                    <button type="submit">delete</button>
                    <svg
                        class="delete danger"
                        aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
                    </svg>
                </a> --}}
            </span>
            
            
            
            
            @endforeach
        @else
            <span class="no-template-available">No template available.</span>
        @endif
        

    </div>

@endsection
