<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">NIM</th>
            <th scope="col">Program Studi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ $row->name }}</td>
                <td>{{ $row->nim }}</td>
                <td>{{ $row->prodi->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
