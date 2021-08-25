<?php require APPROOT .'/views/inc/header.php'; ?>
<div class="main-content">
    <div class="body-container container home text-justify">
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-9">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown button
                </button>
                <div id="dropdown-menu" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                </div>
            </div>
            <table class="table table-bordered table-sm table-striped">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Email</th>
                    <th scope="col">Province</th>
                    <th scope="col">Ndawoni</th>
                    <th scope="col">Bhalise Nini</th>
                    </tr>
                </thead>
                <tbody id="abantu">
                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
        </div>
    </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>
<script>
    ($(document).ready(function () {
        const ourRequest = new XMLHttpRequest();
        ourRequest.open('GET', 'http://localhost/new/experience.json');
        ourRequest.onload = function() {
            let ourData = JSON.parse(ourRequest.responseText);
            let output = '<tr>';
            for(i = 0; i < ourData.abantu.length; i++) {
                output += '<th class="p-0" scope="row">' + ourData.abantu[i].id + '</th>';
                output += '<td class="p-0">' + ourData.abantu[i].igama + '</td>';
                output += '<td class="p-0">' + ourData.abantu[i].fani + '</td>';
                output += '<td class="p-0">' + ourData.abantu[i].email + '</td>';
                output += '<td class="p-0">' + ourData.abantu[i].province + '</td>';
                output += '<td class="p-0">' + ourData.abantu[i].ndawoni + '</td>';
                output += '<td class="p-0">' + ourData.abantu[i].bhalise_nini + '</td></tr>';
                const mabitso = ourData.abantu[i].igama + ' ' + ourData.abantu[i].fani + ' ' + ourData.abantu[i].email.toLowerCase();
            }
            document.getElementById('abantu').innerHTML = output;
        };
        ourRequest.send();
    }))
</script>