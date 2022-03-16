<div class="modal fade" id="newInventory" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="formModal">New Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form method='post' action='new-inventory' onsubmit='show();'  enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
                <label>Category</label>
                <select class="form-control select2" name='category' style='width:100%' required>
                    <option value=''>Select category</option>
                    @foreach($categories as $category)
                        <option value='{{$category->id}}'>{{$category->category_name}}</option>
                    @endforeach
                </select>
                <label>Brand</label>
                <input type="text" name='brand' class="form-control mb-2 mr-sm-2" value="{{ old('brand') }}" placeholder="Brand" required>
                <label>Model</label>
                <input type="text" name='model' class="form-control mb-2 mr-sm-2" value="{{ old('model') }}" placeholder="Model" required>
                <label>Serial Number</label>
                <input type="text" name='serial_number' class="form-control mb-2 mr-sm-2" value="{{ old('serial_number') }}" placeholder="Serial Number" required>
                <label>Description</label>
                <textarea name='description' class="form-control mb-2 mr-sm-2" placeholder="Description" required>{{ old('description') }}</textarea>
                <label>Date Purchased</label>
                <input type="date" name='date_purchased' max='{{date('Y-m-d')}}' class="form-control mb-2 mr-sm-2" value="{{ old('date_purchased') }}" placeholder="Date Purchased" required>
                <label>Cost</label>
                <input type="date" name='date_purchased' max='{{date('Y-m-d')}}' class="form-control mb-2 mr-sm-2" value="{{ old('date_purchased') }}" placeholder="Date Purchased" required>
                <label>Employee Assigned(optional)</label>
                <select class="form-control select2" name='employee' style='width:100%' required>
                    <option value=''>Select employee</option>
                    @foreach($employees as $employee)
                        <option value='{{$employee->badgeno}}'>{{$employee->lastname}}, {{$employee->firstname}} {{$employee->middlename}}</option>
                    @endforeach
                </select>
                
            </div>
            <div class="text-right">
                <button class="btn btn-primary mr-1" type="submit">Save</button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>