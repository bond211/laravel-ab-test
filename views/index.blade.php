@extends ('ab-tests::app')

@section('title', 'Summary')

@section('content')
    <table class="table table-borderless table-hover w-auto shadow">
        <thead>
        <tr>
            <th>Test</th>
            <th colspan="2">Variant</th>
            <th>Goals</th>
        </tr>
        </thead>
        @foreach($stats as $testIdx => $test)
            @foreach($test->variants as $variantIdx => $variant)
                @foreach($variant->goals as $goalIdx => $goal)
                    @include('ab-tests::_summary-row')
                @endforeach
            @endforeach
        @endforeach
        <tfoot class="border-top">
        <tr>
            <td>{{ $stats->count() }} tests</td>
        </tr>
        </tfoot>
    </table>
@endsection
