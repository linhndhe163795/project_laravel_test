@include('clients.header')
<form action="{{ route('team.edit_confirm') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="id">ID:</label>
        <input type="text" class="form-control" name="id" readonly value="{{ $request->id }}">
    </div>
    <div class="form-group">
        <label for="id">Name:</label>
        <input type="text" class="form-control" name="name" id="name" readonly value="{{ $request->name }}">
    </div>
    <button type="button" onclick="goBack()" name="reset" class="btn btn-secondary">Back</button>
    <button type="submit" name="save" class="btn btn-primary">Save</button>
</form>
</body>
<script>
    function goBack() {
        var nameInput = document.getElementById('name');
        nameInput.value = '{{ $request->name }}';
        history.back();
    }
</script>

</html>