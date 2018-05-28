<?php $cols = 5; $col = $cols; ?>

<div class="tradivas-list-container">
    @foreach ($list as $item)
        @if ($col >= $cols)
            <?php $col = 0 ?>
            <div class="row">

            </div>
        @endif
        <div class="col">
            <a href="#">
                <img src="{{ $col->cover->path }}" alt="List item image">
                <div class="tradivas-item-after-img">
                    <div class="tradivas-item-title"></div>
                    <div class="tradivas-item-price"></div>
                </div>
            </a>
        </div>
        <?php ++$col ?>
    @endforeach
</div>