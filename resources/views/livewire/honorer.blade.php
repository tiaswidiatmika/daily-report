<div class="">
    <h2 class="">Pegawai honorer: </h2>
@if ( $usersHonorer !== [] )
    @foreach ( $usersHonorer as $user )
        <span class="">
        {{ $user }}
        <button class="" wire:click.prevent="removeSelectedUser('{{ $user }}', 'usersHonorer')">
            <svg class="" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
        </span>        
    @endforeach
@endif
</div>

<input
    id="searchHonorer"
    type="text"
    placeholder="cari pegawai honorer.."
    wire:model="searchHonorer"
    wire:keyup="search('searchHonorer')"
    class=""
>

@if (!empty( $searchHonorer ))
    <ul
        class=""
    >
    
    @if ( $users !== [] )
        @foreach ($users as $user)
                <li
                    wire:click="clickResult('{{ $user }}', 'searchHonorer', 'usersHonorer')"
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