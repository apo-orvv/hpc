  <script type="text/javascript" src="view/ckeditor/ckeditor.js"></script>
  <h1>Upload a Note</h1>
  <form action="index.php?hpcpage=uploadmanualnote" method="post">
    <div>
	<label>Add a Title</label>
	&nbsp;&nbsp;
	<input type="text" name='description' size='100'/><br/><br/>
      <textarea cols="50" rows="10" id="content" name="content"> 
        &lt;h1&gt;Manual Title&lt;/h1&gt;
        &lt;p&gt;Here's some sample text&lt;/p&gt;
      </textarea><br/><br/>
      <script type="text/javascript">
        CKEDITOR.replace( 'content' );
      </script>
<label>Category </label> &nbsp;&nbsp;
 <select name='category'><option value='HPC'>HPC</option><option value='VDI'>VDI</option><option value='IR'>Internal Report</option> <option value='GEN'>General Documents</option></select><br/><br/>

	<label>Indented For</label>
	&nbsp;&nbsp;
	<select name='indented'><option value='AOU'>Users</option><option value='AO'>Operators & Administrators</option><option value='A'>Administrators Only</option></select><br/><br/>
      <input type="submit" name="submitnote" value="Upload Note"/>
    </div>
  </form>
