<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="formModal">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form class="">
            {{-- <label >Image</label> --}}
            {{-- <input type="file" class="form-control form-control mb-2 mr-sm-2" name='image' required> --}}
            <label >Category Name</label>
            <input type="text" name='category_name' class="form-control mb-2 mr-sm-2" value="{{ old('category_name') }}" placeholder="Category Name" required>
            <label >Category Code</label>
            <input type="text" class="form-control mb-2 mr-sm-2" name='code' value="{{ old('code') }}"  placeholder="Category Code"  required>
            <button type="button" class="btn btn-primary m-t-15 waves-effect">Save</button>
        </form>
        </div>
    </div>
    </div>
</div>