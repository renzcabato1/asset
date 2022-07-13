<div class="modal fade" id="generateQrCode{{$employee->badgeno}}" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">QR Code <button title='Print QR Code' class='btn btn-icon btn-warning fas fa-print' onclick='printDiv("{{$employee->badgeno}}");'> </button></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center border " id='qr_code{{$employee->badgeno}}'>

                <span id='qrGenerate'>{!! QrCode::size(250)->generate('http://192.168.50.119:6060/getDataAccountability?emp_id='.$employee->badgeno); !!}</span> 
                <br>
                <span id='employeeID'></span><br>
                <span class='text-center' id='employeename'>{{$employee->lastname}}, {{$employee->firstname}} {{$employee->middlename}}</span>
            </div>
        </div>
    </div>
</div>
<script>
        function printDiv(data) 
        {
            var divToPrint=document.getElementById('qr_code'+data);
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
            newWin.document.close();
            setTimeout(function(){newWin.close();},10);
        }   
      
</script>