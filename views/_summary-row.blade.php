<tr class="{{ $variantIdx === 0 && $goalIdx === 0 ? 'border-top' : '' }}">
    <td>
        @if($variantIdx === 0 && $goalIdx === 0)
            <strong>{{ $test->name }}</strong>
        @endif
    </td>
    <td class="{{ $goalIdx === 0 ? 'border-top' : '' }}">
        @if($goalIdx === 0)
            {{ $variant->name }}
        @endif
    </td>
    <td class="text-right {{ $goalIdx === 0 ? 'border-top' : '' }}">
        @if($goalIdx === 0)
        {{ number_format($variant->count / $test->variants_count_sum * 100, 1) }}&thinsp;%
        <div class="num-info">{{ $variant->count }}</div>
        @endif
    </td>
    <td class="border-top">
        {{ $goal->name }}
    </td>
    <td class="border-top text-right">
        {{ number_format($goal->count / $variant->count * 100, 1) }}&thinsp;%
        <div class="num-info">{{ $goal->count }}</div>
    </td>
</tr>
