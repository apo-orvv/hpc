<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Edit Article</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>
  <h1>Edit Article</h1>
  <form action="form_handler.php" method="post">
    <div>
      <textarea cols="80" rows="10" id="content" name="content"> 
        &lt;h1&gt;Article Title&lt;/h1&gt;
        &lt;p&gt;Here's some sample text&lt;/p&gt;
      </textarea>
      <script type="text/javascript">
        CKEDITOR.replace( 'content' );
      </script>
      <input type="submit" value="Submit"/>
    </div>
  </form>
</body>
</html>
