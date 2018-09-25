<!DOCTYPE html>
<html>
<head>
	<title>Code Anotate</title>
</head>
<body>
	<form action="{{route('api.testCodeAnotate.post')}}" method="post" enctype="multipart/form-data">
		<input type="file" name="fileTest">
		<input type="submit" name="Enviar" value="Enviar">
	</form>

</body>
</html>