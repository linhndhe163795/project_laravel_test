@include('clients.header')
<?php

use App\Helpers\Constant;
?>

<style>
    .form-control {
        width: 500px;
    }

    .form-group,
    .alert {
        margin-left: 300px;
        width: 500px;
    }

    .container .border {
        border-width: 10rem;

    }
</style>
<div class="container">
    <form id = "create_employee" action="{{route('employee.create_confirm')}}" method="POST">
        <div class="border">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="id">Avatar *</label>

                <img style="max-height: 200px;  max-width: 200px;" src="/storage/images/{{ $request['avatar_image_hidden'] }}" alt="Hình ảnh">
            </div>
            <input type="hidden" readonly class="form-control" name="avatar_image_hidden" value="{{$request['avatar_image_hidden'] }}">
            <div class="form-group">
                <label for="id">Team * </label>
                <input type="text" readonly class="form-control" name="team_id" value="{{$request['team_name']->name}}">
            </div>
            <div class="form-group">
                <label for="id">Email *</label>
                <input type="text" readonly class="form-control" name="email" value="{{$request['request']['email']}}">
            </div>
            <div class="form-group">
                <label for="id">Password *</label>
                <input type="password" readonly class="form-control" name="password" value="{{$request['request']['password']}}">
            </div>
            <div class="form-group">
                <label for="id">First Name *</label>
                <input type="text" readonly class="form-control" name="first_name" value="{{$request['request']['first_name']}}">
            </div>

            <div class="form-group">
                <label for="id">Last Name *</label>
                <input type="text" readonly class="form-control" name="last_name" value="{{$request['request']['last_name']}}">
            </div>

            <div class="form-group">
                <label for="id">Gender *</label>
                &ensp;&ensp;
                <input type="text" readonly class="form-control" name='gender' value="{{($request['request']['status'] == Constant::FEMALE) ? 'Female' : 'Male' }}">
            </div>

            <div class="form-group">
                <label for="id">Birthday *</label>
                <input type="input" readonly class="form-control" name='birthday' value="{{ \Carbon\Carbon::parse($request['request']['birthday'])->format('d/m/Y') }}">
            </div>

            <div class="form-group">
                <label for="id">Address *</label>
                <input type="text" readonly class="form-control" name='address' value="{{$request['request']['address']}}">
            </div>

            <div class="form-group">
                <label for="id">Salary *</label>
                <input type="text" readonly class="form-control" name='salary' value="{{$request['request']['salary']}}">
            </div>

            <div class="form-group">
                <label for="id">Position *</label>
                <input type="text" readonly class="form-control" name='position' value="{{ $request['positions']->name}}">

            </div>

            <div class="form-group">
                <label for="id">Type Of Work *</label>
                <input type="text" readonly class="form-control" name='type_of_work' value="{{$request['type_of_work']->type_of_work}}">
            </div>

            <div class="form-group">
                <label for="id">Status *</label>&ensp;&ensp;
                <input type="text" readonly class="form-control" name='status' value="{{ ($request['request']['status'] == Constant::WORKING) ? 'Working' : 'Retired' }}">
            </div>

            <input type="hidden" class="form-control" name="ins_id" readonly value="{{session('profile')[0]['id']}}">
            <input type="hidden" class="form-control" name="upd_id" readonly value="{{session('profile')[0]['id']}}">
            <input type="hidden" class="form-control" name="del_flag" readonly value="{{Constant::DEL_FLAG_ACTIVE}}">
            <input type="hidden" class="form-control" name="ins_datetime" readonly value="{{ $currentDateTime }}">
            <input type="hidden" class="form-control" name="upd_datetime" readonly value="{{ $currentDateTime }}">

        </div>
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="button" onclick = "goBack()" class="btn btn-secondary">Back</button>
    </form>

</div>
</body>
<script src = "{{asset ('js/employee/employee.js') }}"></script>
<script src="/js/employee/employee.js"></script>
</html>