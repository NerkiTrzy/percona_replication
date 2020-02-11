<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Slave status</h2>
                <table class="table" id="slave-status">
                    <thead class="thead-dark">
                    <tr>
                        <th data-column="Slave_IO_State">Slave IO State</th>
                        <th data-column="Master_Log_File">Log File</th>
                        <th data-column="Read_Master_Log_Pos">POS</th>
                        <th data-column="Seconds_Behind_Master">SBM</th>
                        <th data-column="Last_SQL_Error">LAST ERROR</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td data-column="Slave_IO_State"></td>
                        <td data-column="Master_Log_File"></td>
                        <td data-column="Read_Master_Log_Pos"></td>
                        <td data-column="Seconds_Behind_Master"></td>
                        <td data-column="Last_SQL_Error"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h2>Table size</h2>
                <table class="table" id="count-result">
                    <thead class="thead-dark">
                    <tr>
                        <th>Query</th>
                        <th>MASTER</th>
                        <th>SLAVE</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>SELECT COUNT(*) from mapping_with_index;</td>
                        <td data-count-key="mapping_with_index_master">0</td>
                        <td data-count-key="mapping_with_index_slave">0</td>
                    </tr>
                    <tr>
                        <td>SELECT COUNT(*) from mapping_without_pk;</td>
                        <td data-count-key="mapping_without_pk_master">0</td>
                        <td data-count-key="mapping_without_pk_slave">0</td>
                    </tr>
                    <tr>
                        <td>SELECT COUNT(*) from mapping_with_pk;</td>
                        <td data-count-key="mapping_with_pk_master">0</td>
                        <td data-count-key="mapping_with_pk_slave">0</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    setInterval(function() {
        fetch('slave_status.php')
        .then((response) => response.json())
        .then((result) => {
            let slaveStatusTable = $('#slave-status');
            slaveStatusTable.find("thead tr").children('th').each(function() {
                let key = $(this).data('column');
                if (!result.hasOwnProperty(key)) {
                    //continue
                    return;
                }
                slaveStatusTable.find('tbody td[data-column="' + key + '"]').html(result[key])
            });
        });
        fetch('table_count.php')
        .then((response) => response.json())
        .then((result) => {
            let countResultTable = $('#count-result');
            for (let resultKey in result) {
                let element = result[resultKey];
                countResultTable.find('tbody td[data-count-key="' + element.key + '"]').html(element.value)
            }
        });



    }, 500);

</script>
</body>
</html>
