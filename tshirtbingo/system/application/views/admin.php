<html>
<head>
<title>T-Shirt Bingo Admin</title>
<LINK href="http://www.tshirtbingo.com/style.css" rel="stylesheet" type="text/css" media="screen">
<script src="http://www.tshirtbingo.com/js/jquery.js"></script>
</head>
<body>
<div 
<?php echo form_open('admin/shirts');?>
<table class="card box_round box_shadow">
<tr><th>Shirt ID</th><th>Shirt Name</th><th>Link</th><th>Image</th><th>Company</th><th>Active?</th><th>Frame?</th></tr>
<?php echo $shirt_data;?>
</table>
<input type="submit" value="Submit Changes"/>
</form>
</body>
</html>