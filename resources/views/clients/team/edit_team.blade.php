<link rel="stylesheet" href="../../../css/header.css">

@include('clients.header')
<form action="{{route('team.edit_confirm')}}" method="POST">
    <div class="form-group">
        <label for="id">ID:</label>
        <input type="text" class="form-control" name="id" readonly value="{{$teamTitle->id}}">
    </div>
    <div class="form-group">
        <label for="id">Name:</label>
        <input type="text" class="form-control" id='name' name="name" value="{{empty(old('name')) ? $teamTitle->name : old('name') }}">
    </div>
    @if ($errors->any())
        <p class="alert alert-danger">{{ $errors->first('name') }}</p>
    @endif
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <button type="button" onclick="ResetInput()" class="btn btn-secondary">Reset</button>
    <a href="{{route('team.edit_confirm')}}"><button type="submit" name="confirm" class="btn btn-primary">Confirm</button></a>
</form>


</body>
<script>
    function ResetInput() {
        document.getElementById('name').value = '';
    }
</script>

</html>