<?php
use app\Helpers\Constant;
?>

<link rel="stylesheet" href="../../../css/header.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
@include('clients.header')
<title>Team - Search</title>


<h2>Form Sreach</h2>
<form action="{{ route('team.search') }}" method="GET">
    <!-- <input type="hidden" name="controller" value="search" />
        <input type="hidden" name="action" value="searchAdmin" /> -->
    <div class="input-group input-group-lg mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
        </div>
        <input type="text" id="name" name="name" placeholder="Team Name" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="{{empty($request->name) ? '' : $request->name }}">
    </div>
    <button type="submit" class="btn btn-primary" name="search" value="search">Search</button>
    <button type="button" onclick="ResetInput()" class="btn btn-secondary">Reset</button>
    <div style="color: red"></div>
</form>

<table style="width: 1100px" class="  table table-center bg-white mb-0">
    <thead>
        <tr>
            <th style="width: 200px;"> @sortablelink('ID')</th>
            <th> @sortablelink('Name')</th>
            <th style="width: 200px;">Action</th>
        </tr>
    </thead>
    @if (empty($webName))
    <td colspan="3" style="text-align: center; color: red;">No result found !!!</td>
    @else
    @foreach ($webName as $item)
    <tbody>
        <td>{{ $item->id }}</td>
        <td>{{ $item->name }}</td>
        <td>
            <a href="{{ route('team.edit', ['id' => $item->id]) }}"><button class="btn btn-primary">Edit</button></a>
            <form style="display: inline;" id="form_delete_{{ $item->id }}" action="{{ route('team.delete', ['id' => $item->id]) }}" method="GET">
                <input type="hidden" class="form-control" name="id" readonly value="{{ $item->id }}">
                <input type="hidden" class="form-control" name="del_flag" readonly value="{{ Constant::DEL_FLAG_BAN}}">
                <button type="button" class="btn btn-danger" data-id="{{ $item->id }}" onclick="Delete_team(this)">Delete</button>
            </form>
        </td>
    </tbody>
    @endforeach
    @endif

</table>


<tr>
    <td>
    <td colspan="4">
        &nbsp;
        <div class="d-flex justify-content-right">
            {{ empty($webName) ? "" : $webName->appends(Request::except('page'))->links()  }}
        </div>
    </td>
    <td colspan="3" >
        &nbsp;
        <div class="d-flex justify-content">
            @if ( !empty($webName) && $webName->hasPages())
            <td>Showing {{((($webName->currentPage() -1) * $webName->perPage()) + 1)}} to {{((($webName->currentPage() -1) * $webName->perPage()) + $webName->count()) }} of {{ $webName->total() }} - Page {{ $webName->currentPage() }}/{{ $webName->lastPage() }}</td>
            @endif
        </div>
    </td>
    </td>
</tr>
<div style="color: red; text-align: center; font-size: 30; ">{{empty($message) ? '' : $message}}</div>
</div>
</body>
<script src="{{asset('js/team/team.js')}}"></script>
<script src="/js/team/team.js"></script>
</html>