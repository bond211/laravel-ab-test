<tr class="{{ $variantIdx === 0 && $goalIdx === 0 ? 'border-top' : '' }}">
    <td>
        @if($variantIdx === 0 && $goalIdx === 0)
            <strong>{{ $test->name }}</strong>
            <div class="num-info">
                {{ number_format($test->variants_count_sum) }}
                →
                {{ number_format($test->goals_count_sum) }}
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
        <div class="num-info">{{ number_format($variant->count) }}</div>
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
                number_format( \Bond211\ABTest\ABTestGoalUtil::getConversionRate($goal) * 100, 2)
            }}&thinsp;<small class="text-muted">%</small>
            <div class="num-info">{{ number_format($goal->count) }}</div>
        @endif
    </td>

    <td class="border-top text-right">
        @if($goal !== null)
        {{
            number_format( \Bond211\ABTest\ABTestGoalUtil::getUplift($goal) * 100, 2)
        }}&thinsp;<small class="text-muted">%</small>
        @endif
    </td>
</tr>
