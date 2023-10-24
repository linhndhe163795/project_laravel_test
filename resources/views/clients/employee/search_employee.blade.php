<?php

use app\Helpers\Constant;
?>

<title>Employee - Search</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="../../css/header.css">
@include('clients.header')
<div class="container">
    <div style="border: 1px black;">
        <div>
            <form action="{{route('employee.search')}}">
                Team <div class="dropdown">
                    <select class="form-select" name="teamName" aria-label="Team Name">
                        <option value= "" selected >Choose Team</option>
                        @foreach ($teamName as $o)
                        <option value="{{ $o->name }}" {{ isset($request->teamName) && $request->teamName == $o->name ? 'selected' : '' }}>{{ $o->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id">Name:</label>
                    <input type="text" class="form-control" id='name' name="name" placeholder="Input Team Name" value="{{empty($request->name) ? '' : $request->name }}">
                </div>
                <div class="form-group">
                    <label for="id">Email:</label>
                    <input type="text" class="form-control" id='email' name="email" placeholder="Input Email" value="{{empty($request->email) ? '' : $request->email }}">
                </div>
                <input type="hidden" name="page" value="{{ $listEmployee->currentPage() ?? 'null' }}">


                <button type="submit" class="btn btn-primary" name="search" value="search">Search</button>
                <button type="button" onclick="ResetInput()" class="btn btn-secondary">Reset</button>
               <button type="submit" style="float:right;" name="export" class="btn btn-primary">Export CSV</button>

        </div>
    </div>
    </form>

    <table style="width: 1100px" class="  table table-center bg-white mb-0">
        <thead>
            <tr>
                <th style="width: 200px;"> @sortablelink('ID')</th>
                <th>@sortablelink('Team')</th>
                <th>@sortablelink('Name')</th>
                <th>@sortablelink('Email')</th>
                <th style="width: 200px;">Action</th>
            </tr>
        </thead>
        <tbody>
        @if (empty($listEmployee))
        <td colspan="5" style="color: red; text-align: center;">No result found !!!</td>
        @else
        @foreach ($listEmployee as $item)
       
            <td>{{ $item->id }}</td>
            <td>{{ $item->Team }}</td>
            <td>{{ $item->Name }}</td>
            <td>{{ $item->email }}</td>
            <td>
                <a href="{{ route('employee.edit', ['id' => $item->id]) }}"><button class="btn btn-primary">Edit</button></a>
                <form style="display: inline;" id="form_delete_{{ $item->id }}" action="{{ route('employee.delete', ['id' => $item->id]) }}" method="GET">
                    <input type="hidden" class="form-control" name="id" readonly value="{{ $item->id }}">
                    <input type="hidden" class="form-control" name="del_flag" readonly value="{{Constant::DEL_FLAG_BAN}}">
                    <button type="button" class="btn btn-danger" data-id="{{ $item->id }}" onclick="Delete_team(this)">Delete</button>
                </form>
            </td>
        </tbody>
        @endforeach
        @endif
    </table>
    <div style="color: red; text-align: center; font-size: 30;">{{empty($message) ? "" : $message}}</div>
    <tr>
        <td>
        <td colspan="4">
            &nbsp;
            <div class="d-flex justify-content-right">
                {{ empty($listEmployee) ? "" :$listEmployee->appends(Request::except('page'))->links()}}
            </div>
        </td>
        <td colspan="3">
            &nbsp;

            @if ( !empty($listEmployee) && $listEmployee->hasPages())
        <td>Showing {{((($listEmployee->currentPage() -1) * $listEmployee->perPage()) + 1)}} to {{((($listEmployee->currentPage() -1) * $listEmployee->perPage()) + $listEmployee->count()) }} of {{ $listEmployee->total() }} - Page {{ $listEmployee->currentPage() }}/{{ $listEmployee->lastPage() }}</td>
        @endif
        </td>
        </td>
    </tr>

</div>
</body>

<script src="{{ asset('/js/employee/employee.js') }}"></script>
<script src="/js/employee/employee.js"></script>

</html>
