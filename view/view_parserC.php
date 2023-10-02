<?php
class LogView
{
    public function showForm($error = null)
    {
        echo '
        <!DOCTYPE html>
<html>
<head>
    <title>Log Processing</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            text-align: center;
        }
        label {
            font-size: 18px;
            display: block;
            margin-bottom: 10px;
            color: #333;
        }
        .file-input-label {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .file-input-label:hover {
            background-color: #2980b9;
        }
        button[type="submit"] {
            background-color: #27ae60;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        button[type="submit"]:hover {
            background-color: #2ecc71;
        }
        .error {
            color: #d63031;
            text-align: center;
            margin-top: 10px;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        input[type="file"] {
            display: none;
        }
        .file-input-label::before {
            content: "Browse";
        }
        .file-input-label:hover::before {
            content: "Choose File(s)";
        }
        .file-input-label::after {
            content: "";
            display: inline-block;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 5px 7.5px 5px;
            border-color: transparent transparent #fff transparent;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Log Processing</h1>

        <?php if ($error) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <form method="post" enctype="multipart/form-data">
            <label for="log_files">Choose Log File(s)</label>
            <label class="file-input-label" for="log_files"></label>
            <input type="file" name="log_files[]" id="log_files" required multiple>

            <br><br>

            <label>
                <input type="radio" name="file_mode" value="overwrite" required> Overwrite
                <input type="radio" name="file_mode" value="append" required> Append
            </label>

            <br><br>

            <input type="hidden" name="file_mode_value" id="file_mode_value" value="">

            <button type="submit" name="submit">Process Log(s)</button>
        </form>
    </div>
</body>
</html>

        ';
    }

    public function success(){
        echo '<center><h3>Log File has been successfully parsed and saved in the Database!</h3></center>';
    }
}
