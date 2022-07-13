<div class="modal fade" id="generatedata" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="formModal">Generate Print</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method='post' action='generate-data-return' onsubmit='show();'  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-sm-6'>
                           Employee Code
                        <input type="text" name='employee_code' id='employee_code' class="form-control mb-2 mr-sm-2"  placeholder="Employee Code" required readonly>
                        </div>
                        <div class='col-sm-6'>
                            Name
                        <input type="text" name='name' id='name' class="form-control mb-2 mr-sm-2"  placeholder="Name" required readonly>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6'>
                            Department
                        <input type="text" name='department' id='department' class="form-control mb-2 mr-sm-2"  placeholder="Department" readonly>
                        </div>
                        <div class='col-sm-6'>
                            Position
                        <input type="text" name='position' id='position' class="form-control mb-2 mr-sm-2"  placeholder="Position" readonly>
                        </div>
                        {{-- <div class='col-sm-6'> --}}
                            {{-- Email --}}
                        <input type="hidden" name='email' id='email' class="form-control mb-2 mr-sm-2"  placeholder="Email" readonly>
                        {{-- </div> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover border border-dark " >
                          <thead>
                            <tr class='border border-dark'>
                              <th class='border border-dark'>Category</th>
                              <th class='border border-dark'>Code </th>
                              <th class='border border-dark'>Brand</th>
                              <th class='border border-dark'>Model</th>
                              <th class='border border-dark'>Serial Number</th>
                              <th class='border border-dark'>Description</th>
                              <th class='border border-dark'>Status</th>
                            </tr>
                          </thead>
                          <tbody id='dataAssets'>

                          </tbody>
                        </table>
                    </div>
               
                    <div class='row'>
                        <div class='col-sm-12'>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect float-right">Generate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // var items = {!! json_encode($items->toArray()) !!};
    function generateEmployee(name)
    {
        // console.log(name);
        document.getElementById("employee_code").value = name.emp_code;
        document.getElementById("email").value = name.email;
        document.getElementById("department").value = name.department;
        document.getElementById("position").value = name.position;
        document.getElementById("name").value = name.name;
        $('#dataAssets').empty();
        var inventories = name.return_inventories;
        for (var i = 0; i < inventories.length; i++) {
            if(inventories[i].date_generated == null)
            {
        var dataAssets = "<tr class='border border-dark'><td class='border border-dark'>"+inventories[i].inventory_data.category.category_name+"</td>";
            dataAssets += "<td class='border border-dark'>OBN-"+inventories[i].inventory_data.category.code+"-"+pad("0000",inventories[i].inventory_data.equipment_code,true)+"</td>";    
            dataAssets += "<td class='border border-dark'>"+inventories[i].inventory_data.brand+"</td>";    
            dataAssets += "<td class='border border-dark'>"+inventories[i].inventory_data.model+"</td>";    
            dataAssets += "<td class='border border-dark'>"+inventories[i].inventory_data.serial_number+"</td>";    
            dataAssets += "<td class='border border-dark'>"+nl2br(inventories[i].inventory_data.description)+"</td>";    
            dataAssets += "<td class='border border-dark'>"+(inventories[i].employee_inventories.returned_status)+"</td>";    
            dataAssets += "</tr>";    
            $('#dataAssets').append(dataAssets);
        }
        }
     
    }
    function pad(pad, str, padLeft) {
    if (typeof str === 'undefined') 
        return pad;
    if (padLeft) {
        return (pad + str).slice(-pad.length);
    } else {
        return (str + pad).substring(0, pad.length);
    }
    }

    function nl2br (str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}
  </script>


