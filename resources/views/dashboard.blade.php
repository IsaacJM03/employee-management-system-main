@extends('layouts.admin')

@section('title')
  {{ __('Dashboard') }}
@endsection

@section('header')
  <h1 class="h3 mb-3"><strong>Employee</strong> Dashboard</h1>
@endsection

@section('content')
<ul class="navbar-nav navbar-align">
    <li class="nav-item dropdown">
      <a class="nav-icon nav-link dropdown-toggle" href="javascript:void(0)" id="itemsDropdown" data-bs-toggle="dropdown">
        <i class="align-middle" data-feather="plus"></i>
        <span class="align-middle" style="font-size: 0.85rem;">New Items</span>
      </a>
      <div class="dropdown-menu py-0" aria-labelledby="itemsDropdown">
        <div class="dropdown-menu-header">{{ __('Add New Opion') }}</div>
        <div class="list-group">
          <!-- <a href="{{ route('department.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('Department') }}</span>
          </a>
          <a href="{{ route('designation.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('Designation') }}</span>
          </a>
          <a href="{{ route('employee.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('Employee') }}</span>
          </a>
          <a href="{{ route('attendance.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('Attendance') }}</span>
          </a> -->
          <a href="{{ route('leaves.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('Leave') }}</span>
          </a>
          <!-- <a href="{{ route('payroll.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('Payroll') }}</span>
          </a>
          <a href="{{ route('user.create') }}" class="list-group-item">
            <i class="fas fa-plus align-middle"></i>
            <span class="text-dark ps-2">{{ __('User') }}</span>
          </a> -->
        </div>
      </div>
    </li>
  </ul>
  <section class="row">
	<div class="col-sm-12">
	  <div class="row">
		<div class="col-sm-6">
		  <div class="card">
			<div class="card-body">
			  <div class="row">
				<div class="col mt-0">
				  <a href="{{ route('schedule.index') }}">
					<h5 class="card-title">{{ __('Schedules') }}</h5>
				  </a>
				</div>
				<div class="col-auto">
				  <div class="stat text-primary">
				    <i class="fa-solid fa-clock"></i>
				  </div>
				</div>
			  </div>
			  <h1 class="mt-3 mb-3">
				{{ App\Models\Schedule::count(); }}
			  </h1>
			</div>
		  </div>
		</div>
		<div class="col-sm-6">
		  <div class="card">
			<div class="card-body">
			  <div class="row">
				<div class="col mt-0">
				  <a href="{{ route('leaves.index') }}">
					<h5 class="card-title">{{ __('Leaves') }}</h5>
				  </a>
				</div>
				<div class="col-auto">
				  <div class="stat text-primary">
					<i class="fa-solid fa-users-gear"></i>
				  </div>
				</div>
			  </div>
			  <h1 class="mt-3 mb-3">
				{{ App\Models\Leave::where('employee_id', Auth::user()->id)->count(); }}
			  </h1>
			</div>
		  </div>
		</div>
		<div class="col-sm-6">
		  <div class="card">
			<div class="card-body">
			  <div class="row">
				<div class="col mt-0">
				  <a href="{{ route('attendance.index') }}">
					<h5 class="card-title">{{ __('Attendance') }}</h5>
				  </a>
				</div>
				<div class="col-auto">
				  <div class="stat text-primary">
					<i class="fa-solid fa-users-viewfinder"></i>
				  </div>
				</div>
			  </div>
			  <h1 class="mt-3 mb-3">
				{{ App\Models\Attendance::where('employee_id', Auth::user()->id)->count(); }}
			  </h1>
			</div>
		  </div>
		</div>
		<div class="col-sm-6">
		  <!-- <div class="card">
			<div class="card-body">
			  <div class="row">
				<div class="col mt-0">
				  <a href="{{ route('user.index') }}">
					<h5 class="card-title">{{ __('Users & Members') }}</h5>
				  </a>
				</div>
				<div class="col-auto">
				  <div class="stat text-primary">
					<i class="fas fa-user align-middle"></i>
				  </div>
				</div>
			  </div>
			  <h1 class="mt-3 mb-3">
				{{ App\Models\User::where('status', 1)->count(); }}
			  </h1>
			</div>
		  </div> -->
		</div>
	  </div>
	</div>
	<div class="col-sm-6">
	  <!-- <div class="card flex-fill">
		<div class="card-header">
		  <div class="d-flex align-items-center justify-content-between my- py-0">
			<h5 class="card-title mb-0">{{ __('Users & Members') }}</h5>
			<a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm my-0">
			  <i class="fas fa-eye"></i>
			  <span class="ps-1">{{ __('View') }}</span>
			</a>
		  </div>
		</div>
		<div class="card-body pt-0 mt-0">
		  <table class="table table-hover my-0">
			<thead>
			  <tr>
				<th>{{ __('SL') }}</th>
				<th>{{ __('Name of User') }}</th>
				<th>{{ __('User Role') }}</th>
				<th>{{ __('Date Joined') }}</th>
			  </tr>
			</thead>
			<tbody>
			  @php
				$users = App\Models\User::paginate(4);
			  @endphp
			  @foreach ($users as $user)
				<tr>
				  <td>{{ $loop->iteration }}</td>
				  <td>
					<a href="{{ route('user.edit', $user->id) }}">
					  <strong>{{ $user->name }}</strong>
					</a>
				  </td>
				  <td><span class="badge bg-info">{{ $user->role->title }}</span></td>
				  <td>{{ $user->created_at->diffforhumans() }}</td>
				</tr>
			  @endforeach
			</tbody>
		  </table>
		</div>
	  </div> -->
	</div>
  </section>
  <!-- <section class="row">
	<div class="col-sm-12">
	  <div class="card flex-fill w-100">
		<div class="card-header">
		  <div class="d-flex align-items-center justify-content-between my- py-0">
			<h5 class="card-title mb-0">{{ __('Employee DataTable') }}</h5>
			<a href="{{ route('employee.index') }}" class="btn btn-secondary btn-sm my-0">
			  <i class="fas fa-eye"></i>
			  <span class="ps-1">{{ __('View') }}</span>
			</a>
		  </div>
		</div>
		<div class="card-body pt-0 mt-0">
		  <table class="table table-hover my-0">
			<thead>
				<tr>
				  <th>{{ __('SL') }}</th>
				  <th>{{ __('Name of Employee') }}</th>
				  <th>{{ __('Department') }}</th>
				  <th>{{ __('Designation') }}</th>
				  <th>{{ __('Appointed') }}</th>
				</tr>
			</thead>
			 <tbody>
				@php
				  $employees = App\Models\Employee::paginate(4);
				@endphp
				@foreach ($employees as $employee)
				  <tr>
					<td>{{ $loop->iteration }}</td>
					<td>
					  <a href="{{ route('employee.edit', $employee->id) }}">
						<strong>{{ $employee->firstname . ' ' . $employee->lastname }}</strong>
					  </a>
					</td>
					<td>{{ $employee->department->title }}</td>
					<td>{{ $employee->designation->title }}</td>
					<td>{{ $employee->created_at->diffforhumans() }}</td>
				  </tr>
				@endforeach
			  </tbody>
		  </table>
		</div>
	  </div>
	</div>
  </section> -->
@endsection

@section('script')
@endsection