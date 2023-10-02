<?php
include('view/header.php');
include('view/lmenu.php');
?>

<title>Feature Duration</title>
<link type="text/css" href="view/menu.css" rel="stylesheet" />
<link type="text/css" href="view/style.css" rel="stylesheet" />
<div class="container">
    <h1>Feature Duration Analysis</h1>
    <form method="post" action="featureAnalysis.php">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date"><br><br>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date"><br><br>

        <label>Choose Feature(s):</label><br>
        <input type="checkbox" id="feature_cadimport" name="features[]" value="CADIMPORT">
        <label for="feature_cadimport">CADIMPORT</label><br>

        <input type="checkbox" id="feature_cadimportuser" name="features[]" value="CADIMPORTUSER">
        <label for="feature_cadimportuser">CADIMPORTUSER</label><br>

        <!-- Include checkboxes for other features -->
        <input type="checkbox" id="feature_acdc" name="features[]" value="ACDC">
        <label for="feature_acdc">ACDC</label><br>

        <input type="checkbox" id="feature_cfd" name="features[]" value="CFD">
        <label for="feature_cfd">CFD</label><br>

        <input type="checkbox" id="feature_comsol" name="features[]" value="COMSOL">
        <label for="feature_comsol">COMSOL</label><br>

        <input type="checkbox" id="feature_comsolgui" name="features[]" value="COMSOLGUI">
        <label for="feature_comsolgui">COMSOLGUI</label><br>

        <input type="checkbox" id="feature_comsoluser" name="features[]" value="COMSOLUSER">
        <label for="feature_comsoluser">COMSOLUSER</label><br>

        <input type="checkbox" id="feature_structuralmechanics" name="features[]" value="STRUCTURALMECHANICS">
        <label for="feature_structuralmechanics">STRUCTURALMECHANICS</label><br>

        <input type="checkbox" id="feature_matlib" name="features[]" value="MATLIB">
        <label for="feature_matlib">MATLIB</label><br>

        <input type="checkbox" id="feature_abaqus" name="features[]" value="abaqus">
        <label for="feature_abaqus">abaqus</label><br>

        <input type="checkbox" id="feature_parallel" name="features[]" value="parallel">
        <label for="feature_parallel">parallel</label><br>

        <input type="checkbox" id="feature_standard" name="features[]" value="standard">
        <label for="feature_standard">standard</label><br>

        <br>
        <input type="submit" value="Submit">
    </form>
</div>