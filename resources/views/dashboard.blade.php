@extends('app')

@section('title', 'Todolist Laravel')

@section('import')
    @vite(['resources/css/dashboard.scss', 'resources/js/dashboard.ts'])
@endsection

@section('alerts')
    {{-- Add Todolist Modal --}}
    <div class="modal fade" tabindex="-1" id="add-todolist-modal">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Todolist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="mb-3 form-group">
                        <label for="add-todolist-title" class="form-label">Title</label>
                        <input type="text" name="" id="add-todolist-title" class="form-control">
                        <span class="error" id="error-add-todolist-title"></span>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="add-todolist-content" class="form-label">Content</label>
                        <textarea name="" id="add-todolist-content" rows="7" class="form-control"></textarea>
                        <span class="error" id="error-add-todolist-content"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="add-todolist-modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add-todolist-submit">Save changes</button>
            </div>
        </div>
        </div>
    </div>

    {{-- Update Todolist Modal --}}
    <div class="modal fade" tabindex="-1" id="update-todolist-modal">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Todolist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="mb-3 form-group">
                        <label for="update-todolist-title" class="form-label">Title</label>
                        <input type="text" name="" id="update-todolist-title" class="form-control">
                        <span class="error" id="error-update-todolist-title"></span>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="update-todolist-content" class="form-label">Content</label>
                        <textarea name="" id="update-todolist-content" rows="7" class="form-control"></textarea>
                        <span class="error" id="error-update-todolist-content"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="update-todolist-modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update-todolist-submit">Save changes</button>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container pt-2 pb-2">
        <h2 class="text-center mt-5 mb-5 text-primary">My Todo List</h2>

        <button class="btn btn-primary mb-4" id="add-todolist-button">Add New Todolist</button>

        <table class="table" id="todolist-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

<template id="row-template" style="display: none">
    <tr>
        <td class="iNo">3</td>
        <td class="iTitle">Recycling Bottle</td>
        <td class="iContent">Recycling bottle once a week</td>
        <td class="iAction">
            <button type="button" class="iNotDone btn btn-danger btn-sm mt-1 mb-1">Undone</button>
            <button type="button" class="iDone btn btn-success btn-sm mt-1 mb-1">Done</button>
            <button type="button" class="iUpdate btn btn-warning btn-sm mt-1 mb-1">Edit</button>
            <button type="button" class="iDelete btn btn-danger btn-sm mt-1 mb-1">Delete</button>
        </td>
    </tr>
</template>
@endsection
