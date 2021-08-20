<div class="">
    <div class="">
        <h2 class="">Di Konter Foreigner: </h2>
    </div>
{{-- SHOWS LIST OF USERS SELECTED --}}
@if ( $usersKonterForeigner !== [] )
    @foreach ($usersKonterForeigner as $user)
        <span class="selection">
        {{ $user }}
        <button class="remove-selection" wire:click.prevent="removeSelectedUser('{{ $user }}', 'usersKonterForeigner')">
            &times;
        </button>
        </span>        
    @endforeach
@endif
</div>

<input
    id="searchKonterForeigner"
    {{-- name="searchKonterForeigner" --}}
    type="text"
    placeholder="cari petugas di konter foreigner.."
    wire:model="searchKonterForeigner"
    wire:keyup="search('searchKonterForeigner')"
    class=""
>

@if (!empty( $searchKonterForeigner ))
    <ul
        class="searchResult"
    >
    
    @if ( $users !== [])
        @foreach ($users as $user)
                <li
                    wire:click.prevent="clickResult('{{ $user }}', 'searchKonterForeigner', 'usersKonterForeigner')"
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