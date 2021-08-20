<div class="">
    <h2 class="">yang cutty: </h2>

{{-- SHOWS LIST OF USERS SELECTED --}}
@if ( $usersCuti !== [] )
    @foreach ($usersCuti as $user)
        <span class="selection">
        {{ $user }}
        <button class="remove-selection" wire:click.prevent="removeSelectedUser('{{ $user }}', 'usersCuti')">
            <svg class="" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
        </span>        
    @endforeach
@endif
</div>

<input
    id="searchCuti"
    type="text"
    placeholder="cari petugas di konter Indonesia.."
    wire:model="searchCuti"
    wire:keyup="search('searchCuti')"
    class=""
>

@if (!empty( $searchCuti ))
    <ul
        
        class="searchResult"
    >
    
    @if ( $users !== [] )
        @foreach ($users as $user)
                <li
                    wire:click="clickResult('{{ $user }}', 'searchCuti', 'usersCuti')"
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