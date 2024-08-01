<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="pt-5 d-flex justify-content-between">
            <div class="col">
                <h1>Welcome to ToDo App</h1>
            </div>
            <div class="">
                <a href="/logout" class="btn btn-danger">Logout</a>
            </div>
        </div>

        <!-- create list of books -->
        <div class="row">
            <div class="col-12">
                <h2>ToDo List</h2>
                <a class="btn btn-success" href="/todo/create">Add</a>
            </div>

            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Due Date</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todo as $td)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $td->title }}</td>
                                <td>{{ $td->description }}</td>
                                <td>{{ $td->status }}</td>
                                <td>{{ $td->priority }}</td>
                                <td>{{ $td->due_date }}</td>
                                <td>
                                    <a href="{{ route('todo.edit', $td->id) }}" type="button"
                                        class="btn btn-warning rounded-3">Ubah</a>
                                    <form method="POST" action="{{ route('todo.destroy', $td->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-3">Hapus</button>
                                    </form>
                                </td>
                            </tr> 
                            @endforeach                       
                    </tbody>
                </table>
            </div>
                
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>