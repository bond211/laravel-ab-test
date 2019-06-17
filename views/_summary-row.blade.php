<tr class="{{ $variantIdx === 0 && $goalIdx === 0 ? 'border-top' : '' }}">
    <td>
        @if($variantIdx === 0 && $goalIdx === 0)
            <strong>{{ $test->name }}</strong>
            <div class="num-info">
                {{ $test->variants_count_sum }}
                →
                {{ $test->goals_count_sum }}
            </div>
        @endif
    </td>
    <td class="{{ $goalIdx === 0 ? 'border-top' : '' }}">
        @if($goalIdx === 0)
            {{ $variant->name }}
        @endif
    </td>
    <td class="text-right {{ $goalIdx === 0 ? 'border-top' : '' }}">
        @if($goalIdx === 0)
        {{
            number_format($variant->count / $test->variants_count_sum * 100, 1)
        }}&thinsp;<small class="text-muted">%</small>
        <div class="num-info">{{ $variant->count }}</div>
        @endif
    </td>
    <td class="border-top">
        @if($goal === null)
            <span class="text-muted">no goals yet</span>
        @else
            {{ $goal->name }}
        @endif
    </td>
    <td class="border-top text-right">
        @if($goal === null)
            <span class="text-muted">—</span>
        @else
            {{
                number_format($goal->count / $variant->count * 100, 1)
            }}&thinsp;
            <small class="text-muted">%</small>
            <div class="num-info">{{ $goal->count }}</div>
        @endif
    </td>
</tr>
