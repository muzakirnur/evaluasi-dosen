<!DOCTYPE html>
<html>

<body>
    <h2 class="text-center">{{ $page }}</h2>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">NIP</th>
                <th scope="col">Program Studi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td scope="row">{{ $row->name }}</td>
                    <td scope="row">{{ $row->nip }}</td>
                    <td scope="row">{{ $row->prodi->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
