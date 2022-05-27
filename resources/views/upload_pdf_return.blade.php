<div class="modal fade" id="uploadPDF" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="formModal">Upload File</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method='post' action='upload-pdf-return' onsubmit='show();'  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-sm-12'>
                           Upload Signed Document
                            <input type="hidden" name='transaction' id='transaction' class="form-control mb-2 mr-sm-2"  placeholder="Transaction" required readonly>
                            <input type="file" class="form-control form-control mb-2 mr-sm-2" name='upload_pdf' required>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-12'>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect float-right">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   
    function uploadPDF(id)
    {
       
        document.getElementById("transaction").value = id;
        
    }
  </script>


