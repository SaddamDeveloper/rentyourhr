<div class="box">
    <div class="box-header">
        <h3 class="box-title">Packages</h3>
    </div>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th>Price</th>
                <th>Replacement</th>
            </tr>
            @forelse ($data as $e)
                <tr>
                    <td>{{ $e->amount }}</td>
                    <td>{{ $e->replace_day }} Days</td>
                </tr>
            @empty
                <tr>
                    <td>No Record Found</td>
                </tr>
            @endforelse
        </table>
    </div>
</div>
