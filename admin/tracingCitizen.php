<?php           
    include('../classes/dbcon.class.php');
    include('../classes/admin.class.php');
    $authenAdmin = New Admin();
    $authenAdmin->authAdmin(); 
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Tracing Log</title>
        <!-- Link -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
       
    </head>
    <body>
        <div class="container mt-4 mb-4">
        <a href="index.php"><button type="button" class="mt-2 btn btn-danger">Back To Dashboard</button></a>
            <h5 class="card-title text-center">Tracing Log of RHU - Bulan Automated Contact Tracing System</h5>
            <table class="table table-striped" cellpadding="0" cellspacing="0" border="0" width="100%"  id="myTable">
            <thead>
                <tr>
                    <th>Time and Date</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th>Establishment</th>
                    <th>Temperature</th>
                </tr>
                <tr>
                    <th>Time and Date</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th>Establishment</th>
                    <th>Temperature</th>
                </tr>
            </thead>
                
            <tbody>
                <?php
                    $tracingLog = new Admin();
                    $tracingLog->getTracingTables();
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Time and Date</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th>Establishment</th>
                    <th>Temperature</th>
                </tr>
            </tfoot>
            </table>
            
        </div>

         <!-- Script -->
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
        <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                order: [[0, 'desc']],
                pagingType: 'full_numbers',
                initComplete: function() {
                    this.api().columns().every( function() {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.header()).empty() )
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(val ? '^'+val+'$' :  '', true, false )
                                    .draw();
                            });
                        column.data().unique().sort().each( function( d , j) {
                            select.append('<option value="'+d+'">'+d+'</option>')
                        });
                    });
                },
                createdRow: function ( row, data, index) {
                    if(data[5].replace(/[\.]/g, '') * 1 > 390){
                        $('td', row).eq(5).addClass('text-danger');
                    }
                }
            });
        } );
        </script>
    </body>
</html>