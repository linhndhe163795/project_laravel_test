@include('clients.header')
<div class="container">
    <form action="{{route('team.add_confirm')}}" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <label for="id">Name:</label>
            <input type="text" class="form-control" id='name' name="name" placeholder="Input Team Name" value=" {{ old('name') }}">
            @if ($errors->has('name'))<p class="alert alert-danger">{{ $errors->first('name') }}</p>@endif
        </div>
        <button type="button" onclick="ResetInput()" class="btn btn-secondary">Reset</button>
        <a href="{{route('team.add_confirm')}}"><button type="submit" name="confirm" class="btn btn-primary">Confirm</button></a>
    </form>
</div>
</body>
<script>
    function ResetInput() {
        document.getElementById('name').value = '';
    }
</script>

</html>