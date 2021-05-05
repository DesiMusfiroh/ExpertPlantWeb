<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Expert Plant App</title>

</head>
<body>

<div class="container" style="margin-top: 50px;">

    <h4 class="text-center">Manage Plants</h4><br>

    <h5># Add Plants</h5>
    <div class="card card-default">
        <div class="card-body">
            <form id="addPlant" method="POST" action="">
                <div class="form-group">
                    <label for="name">Plant Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Plant Name">
                </div>
               
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="desc">Plant Description</label>
                        <textarea class="form-control" id="desc" rows="3"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="benefit">Plant Benefits</label>
                        <textarea class="form-control" id="benefit" rows="3"></textarea>
                    </div>
                </div>
                
                <div class="row" >
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="height" class="col-sm-4 col-form-label">Height (mdpl) </label>
                            <div class="col-sm-4">
                            <input type="number" class="form-control" id="min_height" placeholder="Min Height">
                            </div>
                            <div class="col-sm-4">
                            <input type="number" class="form-control" id="max_height" placeholder="Max Height">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="temperature" class="col-sm-4 col-form-label">Air Temperature (C)</label>
                            <div class="col-sm-4">
                            <input type="number" class="form-control" id="min_temperature" placeholder="Min Temperature">
                            </div>
                            <div class="col-sm-4">
                            <input type="number" class="form-control" id="max_temperature" placeholder="Max Temperature">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="humidity" class="col-sm-4 col-form-label">Humidity (%)</label>
                            <div class="col-sm-4">
                            <input type="number" class="form-control" id="min_humidity" placeholder="Min Humidity">
                            </div>
                            <div class="col-sm-4">
                            <input type="number" class="form-control" id="max_humidity" placeholder="Max Humidity">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rainfall" class="col-sm-4 col-form-label">Rainfall (mm/year)</label>
                            <div class="col-sm-4">
                            <input type="number" class="form-control" id="min_rainfall" placeholder="Min Rainfall">
                            </div>
                            <div class="col-sm-4">
                            <input type="number" class="form-control" id="max_rainfall" placeholder="Max Rainfall">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="soil">Type of Soils</label>
                        <div id="soilscheckbox">
                        </div>
                    </div>
                </div>
         
                <button id="savePlant" type="button" class="btn btn-primary mb-2">Save</button>
            </form>
        </div>
    </div>

    <br>

    <h5># Plants</h5>
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Desc</th>
            <th>Benefits</th>
            <th width="180" class="text-center">Action</th>
        </tr>
        <tbody id="tbody">

        </tbody>
    </table>
</div>

<!-- Update Model -->
<form action="" method="POST" class="users-update-record-model form-horizontal">
    <div id="update-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Update</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body" id="updateBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-success updateSoil">Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Delete Model -->
<form action="" method="POST" class="users-remove-record-model">
    <div id="remove-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-danger waves-effect waves-light deleteRecord">Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


{{--Firebase Tasks--}}
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>
<script>
    // Initialize Firebase
    var config = {
        apiKey: "{{ config('services.firebase.api_key') }}",
        authDomain: "{{ config('services.firebase.auth_domain') }}",
        databaseURL: "{{ config('services.firebase.database_url') }}",
        storageBucket: "{{ config('services.firebase.storage_bucket') }}",
    };
    firebase.initializeApp(config);
    var database = firebase.database();
    var lastIndex = 0;


    // Get Soils Data
    firebase.database().ref('soils/').on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                htmls.push(
                    '<div  class="custom-control custom-checkbox">\
                        <input type="checkbox" class="custom-control-input" id="' + index + '" name="soil"  value="' + value.name + '">\
                        <label class="custom-control-label" for="' + index + '">' + value.name + '</label>\
                    </div>'
                );
            }
            lastIndex = index;
        });
        $('#soilscheckbox').html(htmls);
        
    });

    // Add Plant Data
    $('#savePlant').on('click', function () {
        var values = $("#addPlant").serializeArray();
        var name = document.getElementById("name").value;
        var desc = document.getElementById("desc").value;
        var benefit = document.getElementById("benefit").value;
        var min_height = document.getElementById("min_height").value;
        var max_height = document.getElementById("max_height").value;
        var min_temperature = document.getElementById("min_temperature").value;
        var max_temperature = document.getElementById("max_temperature").value;
        var min_humidity = document.getElementById("min_humidity").value;
        var max_humidity = document.getElementById("max_humidity").value;
        var min_rainfall = document.getElementById("min_rainfall").value;
        var max_rainfall = document.getElementById("max_rainfall").value;
        var soil_array = [];
        $("input:checkbox[name=soil]:checked").each(function(){
            soil_array.push($(this).val());
        });
        var plantID = lastIndex + 1;
        console.log(values);
        console.log(soil_array);
        var plantID = lastIndex + 1;
        firebase.database().ref('plants/' + plantID).set({
            name: name,
            desc: desc,
            benefit: benefit,
            min_height: min_height,
            max_height: max_height,
            min_temperature: min_temperature,
            max_temperature: max_temperature,
            min_humidity: min_humidity,
            max_humidity: max_humidity,
            min_rainfall: min_rainfall,
            max_rainfall: max_rainfall,
            soil: soil_array,
        });
        lastIndex = plantID;
        $("#addPlants input").val("");
    });
    

    // Get Plants Data
    firebase.database().ref('plants/').on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
        		<td>' + value.name + '</td>\
        		<td>' + value.desc + '</td>\
                <td>' + value.benefit + '</td>\
        		<td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData" data-id="' + index + '">Update</button>\
        		<button data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="' + index + '">Delete</button></td>\
        	</tr>');
            }
            lastIndex = index;
        });
        $('#tbody').html(htmls);
        $("#submitUser").removeClass('desabled');
    });

    // Update Data
    var updateID = 0;
    $('body').on('click', '.updateData', function () {
        updateID = $(this).attr('data-id');
        firebase.database().ref('soils/' + updateID).on('value', function (snapshot) {
            var values = snapshot.val();
            var updateData = '<div class="form-group">\
		        <label for="first_name" class="col-md-12 col-form-label">Name</label>\
		        <div class="col-md-12">\
		            <input id="name" type="text" class="form-control" name="name" value="' + values.name + '" required autofocus>\
		        </div>\
		    </div>\
		    <div class="form-group">\
		        <label for="last_name" class="col-md-12 col-form-label">Description</label>\
		        <div class="col-md-12">\
		            <input id="desc" type="text" class="form-control" name="desc" value="' + values.desc + '" required autofocus>\
		        </div>\
		    </div>';
            $('#updateBody').html(updateData);
        });
    });
    $('.updateSoil').on('click', function () {
        var values = $(".users-update-record-model").serializeArray();
        var postData = {
            name: values[0].value,
            desc: values[1].value,
        };
        var updates = {};
        updates['/soils/' + updateID] = postData;
        firebase.database().ref().update(updates);
        $("#update-modal").modal('hide');
    });

    // Remove Plant Data
    $("body").on('click', '.removeData', function () {
        var id = $(this).attr('data-id');
        $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
    });
    $('.deleteRecord').on('click', function () {
        var values = $(".users-remove-record-model").serializeArray();
        var id = values[0].value;
        firebase.database().ref('plants/' + id).remove();
        $('body').find('.users-remove-record-model').find("input").remove();
        $("#remove-modal").modal('hide');
    });
    $('.remove-data-from-delete-form').click(function () {
        $('body').find('.users-remove-record-model').find("input").remove();
    });
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
