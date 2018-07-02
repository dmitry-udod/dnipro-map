<a href="{{ route("admin.$viewName.edit", [$city->slug, $entity->id]) }}" class="btn {{ $entity->is_processed ? '' : 'btn-primary' }} btn-sm">
    {{ $entity->is_processed ? 'Переглянути' : 'Опрацювати' }}
</a>