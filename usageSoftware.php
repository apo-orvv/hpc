<?php
include('view/header.php');
include('view/lmenu.php');
?>

<title>Usage Statistics</title>
<link type="text/css" href="view/menu.css" rel="stylesheet" />
<link type="text/css" href="view/style.css" rel="stylesheet" />

<div class="container">
    <h1>Usage Statistics</h1>
    <form method="post">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date">

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date">

        <label for="software_type">Software Type:</label>
        <select id="software_type" name="software_type">
            <option value="Abaqus">Abaqus</option>
            <option value="COMSOL">COMSOL</option>
        </select>

        <label for="distribution_type">Distribution Type:</label>
        <select id="distribution_type" name="distribution_type">
            <option value="User">User</option>
            <option value="Machine">Machine</option>
        </select>

        <input type="submit" value="Submit">
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];
    $softwareType = $_POST["software_type"];
    $distributionType = $_POST["distribution_type"];

    if ($distributionType == "User") {
        echo '<script>window.location.href = "usageUser.php?start_date=' . $startDate . '&end_date=' . $endDate . '&software_type=' . $softwareType . '";</script>';
        exit;
    } elseif ($distributionType == "Machine") {
        echo '<script>window.location.href = "usageMachine.php?start_date=' . $startDate . '&end_date=' . $endDate . '&software_type=' . $softwareType . '";</script>';
        exit;
    }
}
?>