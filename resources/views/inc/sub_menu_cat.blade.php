@if ($category->subCategories->isNotEmpty())
    <div class="dropdown-menu">
        @foreach ($category->subCategories as $sub_category)
            <a href="/cat/{{ $sub_category->link }}" class="dropdown-item">{{ ucwords($sub_category->name) }}</a>
        @endforeach
    </div>
@endif
