<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">ID Mahasiswa</th>
            <th scope="col">ID Dosen</th>
            <th scope="col">Nilai</th>
            <th scope="col">Saran</th>
            <th scope="col">Grade</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ $row->mahasiswa_id }}</td>
                <td>{{ $row->dosen_id }}</td>
                <td>{{ $row->nilai }}</td>
                <td>{{ $row->saran }}</td>
                <td>{{ $row->grade }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
