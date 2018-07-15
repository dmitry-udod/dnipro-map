@if (! $entity->is_structure_created)
<a href="{{ route('admin.structures.create_from_user_request', [$city->slug, $entity->id]) }}" class="btn btn-sm btn-success mt-1" style="zoom: .95">Створити об'экт</a>
@endif