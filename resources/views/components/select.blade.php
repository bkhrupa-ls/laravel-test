@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }}

    {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
>
    @foreach ($attributes->get('options', []) as $key => $label)
        <option value="{{ $key }}" @if($attributes->get('value') == $key) selected="selected" @endif>
            {{ $label }}
        </option>
    @endforeach
</select>
