@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    {{ __('User List') }} <a href="{{ route('admin.users.create') }}"
                                        class="btn btn-primary float-end ajax-click-page">{{ __('Add
                                                                                                                                                                                User') }}</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($users)
                                            @forelse ($users as $item)
                                                <tr>
                                                    <td class="text-center">{{ $item->username }}</td>
                                                    <td class="text-center">{{ $item->email }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.users.edit', $item->id) }}"
                                                            class="btn btn-primary btn-sm ajax-click-page">Edit</a>
                                                        <a href="{{ route('admin.users.destroy', $item->id) }}"
                                                            class="btn btn-danger btn-sm ajax-delete">Delete</a>
                                                    </td>
                                                </tr>

                                            @empty

                                                <tr>
                                                    <td colspan="3" class="text-center">No data Found</td>
                                                </tr>
                                            @endforelse
                                        @endisset
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
