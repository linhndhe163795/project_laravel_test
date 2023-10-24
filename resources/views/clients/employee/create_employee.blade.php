<?php

use app\Helpers\Constant;
?>

@include('clients.header')
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
    <form action="{{route('employee.create_confirm')}}" method="POST" enctype="multipart/form-data">
        <div class="border">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group">
                <label for="id">Avatar *</label>
                <input type="file"   id="avatar_image" class="form-control" name="avatar_image" value="{{old('avatar')}}">

                <input type="hidden" id="avatar_image_hidden" name="avatar_image_hidden" value="{{ old('avatar_image_hidden') }}">
            </div>
            @if ($errors->has('avatar'))<p class="alert alert-danger">{{ $errors->first('avatar') }}</p>@endif

            


            <div class="form-group">
                <label for="id">Team * </label>
                <select class="form-control" name='team_name'>
                    @foreach($teamName as $o)
                    <option value='{{$o->id}}'>{{$o->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id">Email *</label>
                <input id="email" type="text" class="form-control" name="email" placeholder="Input Email" value="{{old('email')}}">
            </div>
            @if ($errors->has('email'))<p class="alert alert-danger">{{ $errors->first('email') }}</p>@endif

            <div class="form-group">
                <label for="id">First Name *</label>
                <input id = "first_name" type="text" class="form-control" name="first_name" placeholder="Input First Name" value="{{old('first_name')}}">
            </div>
            @if ($errors->has('first_name'))<p class="alert alert-danger">{{ $errors->first('first_name') }}</p>@endif        

            <div class="form-group">
                <label for="id">Last Name *</label>
                <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Input Team Name" value="{{old('last_name')}}">
            </div>
            @if ($errors->has('last_name'))<p class="alert alert-danger">{{ $errors->first('last_name') }}</p>@endif

            <div class="form-group">
                <label for="id">Password *</label>
                <input id="password" type="password"  class="form-control" name="password" placeholder="Input Password" value="{{old('password')}}">
            </div>
            @if ($errors->has('password'))<p class="alert alert-danger">{{ $errors->first('password') }}</p>@endif

            <div class="form-group">
                <label for="id">Gender *</label>
                &ensp; &ensp;
                <label class="radio-inline">
                    <input name='gender' type="radio" value='{{Constant::MALE}}' @if(old('gender')==Constant::MALE) checked @endif> Male &ensp; &ensp;
                </label>
                <label class="radio-inline">
                    <input name='gender' type="radio" value='{{Constant::FEMALE}}' @if(old('gender')==Constant::FEMALE) checked @endif> Female
                </label>
            </div>
            @if ($errors->has('gender'))<p class="alert alert-danger">{{ $errors->first('gender') }}</p>@endif

            <div class="form-group">
                <label for="id">Birthday *</label>
                <input type="date" name='birthday' class="form-control" value="{{old('birthday')}}">
            </div>
            @if ($errors->has('birthday'))<p class="alert alert-danger">{{ $errors->first('birthday') }}</p>@endif

            <div class="form-group">
                <label for="id">Address *</label>
                <input id = "address" type="text" class="form-control" name='address' placeholder="Input Address" value="{{old('address')}}">
            </div>
            @if ($errors->has('address'))<p class="alert alert-danger">{{ $errors->first('address') }}</p>@endif

            <div class="form-group">
                <label for="id">Salary *</label>
                <input id= "salary" type="text" class="form-control" name='salary' placeholder="Input Team Name" value="{{old('salary')}}">
            </div>
            @if ($errors->has('salary'))<p class="alert alert-danger">{{ $errors->first('salary') }}</p>@endif

            <div class="form-group">
                <label for="id">Position *</label>
                <select class="form-control" name='position'>
                    @foreach($position as $o)
                    <option value='{{$o->id}}'>{{$o->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id">Type Of Work *</label>
                <select class="form-control" name='type_of_work'>
                    @foreach($typeOfWork as $o)
                    <option value='{{$o->id}}'>{{$o->type_of_work}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id">Status *</label>&ensp;&ensp;
                <label class="radio-inline">
                    <input name='status' type="radio" value='{{Constant::WORKING}}' @if(old('status')==Constant::WORKING) checked @endif> On Working&ensp;&ensp;
                </label>
                <label class="radio-inline">
                    <input name='status' type="radio" value='{{Constant::RETIRED}}' @if(old('status')==Constant::RETIRED) checked @endif> Retired
                </label>
            </div>
            @if ($errors->has('status'))<p class="alert alert-danger">{{ $errors->first('status') }}</p>@endif
        </div>

        <a href="{{route('employee.create_confirm')}}"><button type="submit" name="confirm" class="btn btn-primary">Confirm</button></a>
        <button type="button" onclick="ResetInput()" class="btn btn-secondary">Reset</button>

    </form>

</div>
</body>
<script src = "{{asset ('employee/employee.js') }}"></script>
<script src="/js/employee/employee.js"></script>
</html>
