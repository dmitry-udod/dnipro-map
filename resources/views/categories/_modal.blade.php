<!-- Category Modal -->
<div class="modal fade blue" id="categories" tabindex="-1" role="dialog" aria-labelledby="categories" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Оберіть категорію для відображення</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled categories-modal">
                    @foreach($categories as $category)
                        <li class="col-md-6">
                            <div class="row">
                                @if (!empty((json_decode($category->logo))))
                                    <img src="{{ json_decode($category->logo)->path }}">&nbsp;
                                @endif
                                <a href="{{ route('categories', [$city->slug, $category->slug]) }}">{{ $category->name }}</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @php
    session()->put('hide_category_modal', true)
    @endphp
</div>