<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Mahasiswa</th>
            <th scope="col">Matakuliah</th>
            <th scope="col">Program Studi</th>
            <th scope="col">Nama Dosen</th>
            <th scope="col">Nilai</th>
            <th scope="col">Saran</th>
            <th scope="col">Grade</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td scope="row">{{ $row->mahasiswa->name }}</td>
                <td scope="row">{{ $row->matakuliah->matakuliah }}</td>
                <td scope="row">{{ $row->mahasiswa->prodi->name }}</td>
                <td scope="row">{{ $row->matakuliah->dosen->name }}</td>
                <td scope="row">{{ $row->nilai }}</td>
                <td scope="row">{{ $row->saran }}</td>
                <td scope="row">{{ $row->grade }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
