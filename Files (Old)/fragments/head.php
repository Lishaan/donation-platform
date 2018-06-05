<?php function render_head($title) { ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Donation Platform - <?php echo $title ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cloud.github.com/downloads/javanto/civem.js/civem-0.0.7.min.js"></script>
    <!-- script>
    $(document).ready(function() {
        $('form > input').keyup(function() {

            var empty = false;
            $('form > input[required]').each(function() {
                if ($(this).val() == '') {
                    empty = true;
                }
            });

            if (empty) {
                $('#register_submit').attr('disabled', 'disabled');
                $('#login_submit').attr('disabled', 'disabled');
            } else {
                $('#register_submit').removeAttr('disabled');
                $('#login_submit').removeAttr('disabled');
            }
        });
    });

    $('#register_submit').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });
    </script> -->
</head>

<?php } ?>