<form action="{{ url('project_detail/update_detail') }}" method="post">
    {!! csrf_field() !!}
    <div class="row">
        <input type="hidden" name="project_detail_id" value="{{ $data->id }}">
        <div class="col-lg-12">
            <div class="form-group mb-3">
                <label for="exampleInputText02" class="h5">Task Name</label>
                <input type="text" name="task_name" value="{{ $data->task_name }}" class="form-control" id="exampleInputText02" placeholder="Enter task Name">
                <a href="#" class="task-edit text-body"><i class="ri-edit-box-line"></i></a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group mb-3">
                <label for="exampleInputText2" class="h5">Assigned to</label>
                <select class="form-control" name="assigned_to" data-style="py-0">
                    @foreach($users as $item)
                        <option @if($data->assigned_to == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group mb-3">
                <label for="exampleInputText05" class="h5">Due Dates*</label>
                <input type="date" class="form-control" value="{{ $data->due_dates }}" id="exampleInputText05" name="due_dates">
            </div>                        
        </div>
        <div class="col-lg-4">
            <div class="form-group mb-3">
                <label for="exampleInputText2" class="h5">Category</label>
                <input type="text" class="form-control" value="{{ $data->category }}" id="exampleInputText05" name="category">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group mb-3">
                <label for="exampleInputText040" class="h5">Description</label>
                <textarea class="form-control" name="description" id="exampleInputText040" rows="2">{{ $data->description }}</textarea>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group mb-3">
                <label for="exampleInputText005" class="h5">Checklist</label>
                <textarea class="form-control" name="checklist" id="exampleInputText040" rows="2">{{ $data->checklist }}</textarea>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-ceter justify-content-center mt-4">
                <button class="btn btn-primary mr-3" type="submit">Save</button>
                <div class="btn btn-danger" data-dismiss="modal">Cancel</div>
            </div>
        </div>
    </div>
</form>