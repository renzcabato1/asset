<div class="modal fade" id="generatedata" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="formModal">Generate Print</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method='post' action='generate-data' onsubmit='show();'  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col-sm-6'>
                           Asset Code
                        <input type="text" name='employee_code' id='employee_code' class="form-control mb-2 mr-sm-2"  placeholder="Employee Code" required readonly>
                        <input type="hidden" name='employee_codes' id='employee_codes' class="form-control mb-2 mr-sm-2"  placeholder="Employee Code" required readonly>
                        <input type="hidden" name='department_data' id='department_data' class="form-control mb-2 mr-sm-2"  placeholder="department_data" required readonly>
                        <input type="hidden" name='email_address' id='email_address' class="form-control mb-2 mr-sm-2"  placeholder="Employee Code" required readonly>
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
                    </div>
                    
                    <div class='row border'>
                        <div class='col-sm-4 border'>
                            Code
                        </div>
                        <div class='col-sm-2 border'>
                            Brand 
                        </div>
                        <div class='col-sm-3 border'>
                            Model 
                        </div>
                        <div class='col-sm-3 border'>
                            Serial Number 
                        </div>
                    </div>
                    <div id='dataAssets'>
                     
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
    var employees = {!! json_encode($employees->toArray()) !!};
    var assetCodes = {!! json_encode($assetCodes->toArray()) !!};
    var assetCodesDepartment = {!! json_encode($assetCodesDepartment->toArray()) !!};
    function generateEmployee(name)
    {
        var employee = employees.find(employee => employee.badgeno == name.emp_code);
        if(name.department != null)
        {
            var inventories = name.employee_inventories_department;
            var code = assetCodesDepartment.find(code => code.employee_id === name.emp_code);
            document.getElementById("employee_code").value = "OBN-"+name.department+"-"+pad("0000",code.code,true);
        }
        else
        {
            var inventories = name.employee_inventories;
            var code = assetCodes.find(code => code.employee_id === name.emp_code);
            document.getElementById("employee_code").value = "OBN-ASSET-"+pad("0000",code.code,true);
        }
        document.getElementById("employee_codes").value = name.emp_code;
        document.getElementById("department_data").value = name.department;
        document.getElementById("email_address").value = employee.emailaddress;
        document.getElementById("department").value = employee.department;
        document.getElementById("position").value = employee.position;
        document.getElementById("name").value = employee.firstname+" "+employee.middlename+" "+employee.lastname;
        $('#dataAssets').empty();
        for (var i = 0; i < inventories.length; i++) {

            var dataAssets = "<div class='row border'><div class='col-sm-4 border'>OBN-"+inventories[i].inventory_data.category.code+"-"+pad("0000",inventories[i].inventory_data.equipment_code,true)+"";
                dataAssets += "</div>";    
                dataAssets += "<div class='col-sm-2 border'>";    
                dataAssets += inventories[i].inventory_data.brand;    
                dataAssets += "</div>";    
                dataAssets += "<div class='col-sm-3 border'>";    
                dataAssets += inventories[i].inventory_data.model;    
                dataAssets += "</div>";    
                dataAssets += "<div class='col-sm-3 border'>";    
                dataAssets += inventories[i].inventory_data.serial_number;    
                dataAssets += "</div></div>";    
                $('#dataAssets').append(dataAssets);
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
  </script>


