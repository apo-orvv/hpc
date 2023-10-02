  <h1>Upload a File</h1>
  <form action="index.php?hpcpage=uploadmanualfile"  enctype="multipart/form-data" method="post">
    <div>
	<label>Add a Title</label>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" name='description' size='100'/><br/><br/>
	<label> Select a File</label>&nbsp;&nbsp;&nbsp;

	<input type='file' name='manualfile'><br/><br/>
	<label>Category	</label> &nbsp;&nbsp;
 <select name='category'><option value='HPC'>HPC</option><option value='VDI'>VDI</option><option value='IR'>Internal Report</option><option value='GEN'>General Documents</option></select><br/><br/>
	<label>Indented For</label>
	&nbsp;&nbsp;
	<select name='indented'><option value='AOU'>Users</option><option value='AO'>Operators & Administrators</option><option value='A'>Administrators Only</option></select><br/><br/>
      <input type="submit" name="submitfile" value="Upload File"/>
    </div>
  </form>
