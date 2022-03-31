<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="crcform">

<h1>Internship Details</h1>

    <form name="internship_details" id="intership_details" action="store.php" method="POST">
        <table class="table table-bordered" id="dynamic_field">
            <tr>
                <td>
                    <!--div class="top-row"-->
                    <div class="field-wrap">
                      <label>
                        Company<span class="req">*</span>
                      </label>
                      <input type="text" required autocomplete="off" name="company[]"/>
                    </div>

                    <div class="field-wrap">
                      <label>
                        Project<span class="req">*</span>
                      </label>
                      <input type="text"required autocomplete="off" name="project[]"/>
                    </div>

                    <div class="field-wrap">
                      <label>
                        Duration<span class="req">*</span>
                      </label>
                      <input type="text"required autocomplete="off" name="duration[]"/>
                    </div>

                    <div class="field-wrap">
                      <label>
                        Key Learning<span class="req">*</span>
                      </label>
                      <input type="text"required autocomplete="off" name="key_learning[]"/>
                    </div>
                </td>
                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
            </tr>
        </table>
        <input type="button" name="submit" id="submit"  class="btn btn-info" value="Submit" />
        <!--div class="top-row">
        <div class="field-wrap">
        <button class="button button-block" name="submit" id="submit"/>NEXT</button> 
        </div-->

    </form>
</div>

<script>
$(document).ready(function(){
    var i = 1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><div class="field-wrap"><label>Company<span class="req">*</span></label><input type="text" required autocomplete="off" name="company[]"/></div><div class="field-wrap"><label>Project<span class="req">*</span></label><input type="text"required autocomplete="off" name="project[]"/></div><div class="field-wrap"><label>Duration<span class="req">*</span></label><input type="text"required autocomplete="off" name="duration[]"/></div><div class="field-wrap"><label>Key Learning<span class="req">*</span></label><input type="text"required autocomplete="off" name="key_learning[]"/></div></td></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
    });
    $(document).on('click','.btn_remove', function(){
        var button_id = $(this).attr("id");
        $("#row"+button_id+"").remove();
    });

    $('#sumbit').clic(function(){
        $.ajax({
            url:"internship_details.php",
            method:"POST",
            data:$('#internship_details').serialize(),
            success:function(data)
            {
                alert(data);
                $('#internship_details')[0].reset();
            }
        });
    });
});
</script>
</body>
</html>