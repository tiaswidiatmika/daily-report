<div class="">
    <h2 class="">Di Konter Indonesia: </h2>

{{-- SHOWS LIST OF USERS SELECTED --}}
@if ( $usersKonterIndonesia !== [] )
    @foreach ($usersKonterIndonesia as $user)
        <span class="selection">
        {{ $user }}
        <button class="remove-selection" wire:click.prevent="removeSelectedUser('{{ $user }}', 'usersKonterIndonesia')">
            &times;
        </button>
        </span>        
    @endforeach
@endif
</div>

<input
    id="searchKonterIndonesia"
    type="text"
    placeholder="cari petugas di konter Indonesia.."
    wire:model="searchKonterIndonesia"
    wire:keyup="search('searchKonterIndonesia')"
    class=""
>

@if (!empty( $searchKonterIndonesia ))
    <ul
        class="searchResult"
    >
    
    @if ( $users !== [] )
        @foreach ($users as $user)
                <li
                    wire:click="clickResult('{{ $user }}', 'searchKonterIndonesia', 'usersKonterIndonesia')"
                    class="">
                    {{ $user }}
                </li>
        @endforeach
    @else
        <li
        class=""
        >
            No such result
        </li>
    @endif
    </ul>
@endif

<hr class="">