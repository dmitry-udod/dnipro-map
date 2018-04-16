<button type="button" class="btn btn-danger btn-sm" onclick="
	event.preventDefault();
	if (confirm('Ви впевненi що бажаєте видалити запис?')) {
		document.getElementById('{{ $viewName }}{{ $entity->id }}').submit();
	}
">
    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 8 8">
        <path style="fill:white" d="M3 0c-.55 0-1 .45-1 1h-1c-.55 0-1 .45-1 1h7c0-.55-.45-1-1-1h-1c0-.55-.45-1-1-1h-1zm-2 3v4.81c0 .11.08.19.19.19h4.63c.11 0 .19-.08.19-.19v-4.81h-1v3.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-3.5h-1v3.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-3.5h-1z"  />
    </svg>
</button>

<form id="{{ $viewName }}{{ $entity->id }}" action="{{ route("admin.$viewName.destroy", [$city->slug, $entity->id]) }}" method="POST" style="display: none;">
    <input type="hidden" value="DELETE" name="_method">
    @csrf
</form>