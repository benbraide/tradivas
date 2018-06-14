<?php $units = array('px', 'em', 'rem', '%'); ?>
<select name="{{ $unit_name }}" class="form-control tradivas-unit">
    @foreach ($units as $unit)
        @if ((isset($active_unit) && $unit == $active_unit) || (!isset($active_unit) && $unit == "px"))
            <option value="{{ $unit }}" selected="selected">{{ $unit }}</option>
        @else
            <option value="{{ $unit }}">{{ $unit }}</option>
        @endif
    @endforeach
</select>
