<!DOCTYPE html>
<html lang="en">
<head>
    <? include 'head.php'; ?>
    <script type="text/javascript">
        $(document).ready(() => $('#nav-distance').addClass('active'))
    </script>
    <style type="text/css">
        input {
            width: 100%;
        }
    </style>
</head>
<body>
    <? include 'navbar.php' ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="" method="post">
                    <input type="text" name="origin" class="form-control" placeholder="Origin address" aria-describedby="sizing-addon1">
                    <input type="text" name="destination" class="form-control" placeholder="Destination address" aria-describedby="sizing-addon1">
                    <button style="margin-top: 1rem;" type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
</body>

<?php
if ($_POST && array_key_exists('origin', $_POST) && array_key_exists('destination', $_POST)) {
    $data = distance($_POST['origin'], $_POST['destination']);
    $origin = $data['origin'];
    $destination = $data['destination'];
    $distance = $data['distance'];
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <dl class="dl-horizontal">
                    <dt>From</dt>
                    <dd><?=$origin?><dd>
                    <dt>To</dt>
                    <dd><?=$destination?><dd>
                    <dt>Distance</dt>
                    <dd><?=$distance?><dd>
                </dl>
        </div>
    </div>
    <?php
}
?>
