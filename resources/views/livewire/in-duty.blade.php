<form
    wire:submit.prevent="submit"
    method="post"
    class="main-page-container"
    wire:keydown.escape="clearResults()"
>

    @if ( $formationHasBeenSet )
        <a href="{{ route('presence-report') }}">Preview result</a>
    @endif
    <p class="page-title">Compose presence</p>

    @foreach ($textFields as $fieldId => $value)
        @php
            $field = \App\Models\Position::find($fieldId);
        @endphp
        <strong><label for="{{ $field }}">{{ $field->display_name }}</label></strong>
        <input
            type="text"
            autocomplete="off"
            name="{{ $fieldId }}"
            wire:model="textFields.{{ $fieldId }}"
            wire:keyup="search('{{ $fieldId }}')"
        >
        @if ( !empty($textFields[$fieldId]) )
            @if ( !empty($searchResult[$fieldId]) )
                <div class="searchResultContainer">
                    @foreach ($searchResult[$fieldId] as $user)
                        <div
                            class="searchResult"
                            wire:click="select('{{ $fieldId }}', '{{ $user['id'] }}')"
                        >
                            {{ $user['alias'] }}
                        </div>
                    @endforeach
                </div>
            @else
                <span class="searchResultContainer">no user found</span>
            @endif
        @endif    
            <div class="selection-container">
                @foreach ($formation[$fieldId] as $user)
                    <span class="selection">
                        {{ $user['alias'] }}
                        <button
                            class="remove-selection"
                            wire:click.prevent="remove('{{ $fieldId }}', '{{ $user['id'] }}')">&times;</button>
                    </span>
                @endforeach
            </div>
        @endforeach
    <button type="submit">submit</button>
</form>
