<!DOCTYPE html>
<html lang="en">
<head>
    <? include 'head.php'; ?>
    <script type="text/javascript">
        $(document).ready(() => $('#nav-address').addClass('active'))
    </script>
</head>
<body>
    <? include 'navbar.php' ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="" method="post">
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="address" placeholder="Enter any address" />
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?php
if ($_POST && array_key_exists('address', $_POST)) {
    $data = geocode($_POST['address']);
    $latitude = $data[0];
    $longitude = $data[1];
    $formattedAddress = $data[2];
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <dl class="dl-horizontal">
                    <dt>Address</dt>
                    <dd><?=$formattedAddress?><dd>
                    <dt>Latitude</dt>
                    <dd><?=$latitude?><dd>
                    <dt>Longitude</dt>
                    <dd><?=$longitude?><dd>
                </dl>
        </div>
    </div>
    <?php
}
?>

</html>
