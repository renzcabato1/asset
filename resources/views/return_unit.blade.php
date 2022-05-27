<div class="modal fade" id="return_unit" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="formModal">Return Unit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method='post' action='return-item' onsubmit='show();'  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input name='idAccountability' type='hidden' id='idAccountability' required>
                    <input name='name' type='hidden' id='name' required>
                    <input name='asset_code' type='hidden' id='asset_code' required>
                    <input name='position' type='hidden' id='position' required>
                    <input name='department' type='hidden' id='department' required>
                    <input name='emp_code' type='hidden' id='emp_code' required>
                    <input name='email' type='hidden' id='email' required>
                    <label >Status</label>
                    <select name='status' id='status' class='form-control mb-2 mr-sm-2' required>
                        <option value=''></option>
                        <option value='Active'>Good Condition</option>
                        <option value='For Repair'>For Repair</option>
                        <option value='For Disposal'>For Disposal</option>
                    </select>
                    <label >Remarks</label>
                    <textarea onkeyup="setHeight('description');" style="height: 100px;" onkeydown="setHeight('description');" id='description' name='description' class="form-control" placeholder="Description" required>{{ old('description') }}</textarea>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>