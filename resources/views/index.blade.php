@extends('parent')

@section('main')

<table class="table table-bordered table-striped">
 <tr>
  <th width="10%">Photo</th>
  <th width="35%">Name</th>
  <th width="35%">Userid</th>
  <th width="30%">Task</th>
 </tr>
 @foreach($data as $row)
  <tr>
   <td><img src="{{ URL::to('/') }}/images/{{ $row->image }}" class="img-thumbnail" width="75" /></td>
   <td>{{ $row->first_name }}</td>
   <td>{{ $row->last_name }}</td>
   <td>
    <form action="{{ route('crud.destroy', $row->id) }}" method="post">
        <a href="{{ route('crud.show', $row->id) }}" class="btn btn-primary">Show</a>
        <a href="{{ route('crud.edit', $row->id) }}" class="btn btn-warning">Edit</a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
   </td>
  </tr>
 @endforeach
</table>
{!! $data->links() !!}
@endsection
