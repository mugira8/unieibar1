<?php
// assign defaults
$data = array('email' 		=> 'email',
			  'firstname' 	=> 'nombre',
			  'lastname' 	=> 'apellidos',
			  'postcode' 	=> 'codigo postal',
			  'city' 		=> 'ciudad',
			  'stateProv' 	=> 'provincia',
			  'country'		=> 'pais',
			  'telephone' 	=> 'telefono',
			  'password' 	=> 'contraseña',
			  'password2' 	=> 'repetir contraseña',
			  'imagen'      => ''
);
$error = array('email' 	  => '',
			  'firstname' => '',
			  'lastname'  => '',
			  'city'	  => '',
			  'stateProv' => '',
			  'country'	  => '',
			  'postcode'  => '',
			  'telephone' => '',
			  'password'  => '',
);
if (isset($_POST['data'])) {
	$data = $_POST['data'];

	$formatos_permitidos =  array('png','jpeg','jpg', 'gif');
	$archivo = $_FILES['imagen']['name'];
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	if(!in_array($extension, $formatos_permitidos) ) {
    	die('Error formato de imagen no permitido !!');
	}else{
		$path = "perfiles/".basename($_FILES['imagen']['name']);
		move_uploaded_file($_FILES['imagen']['tmp_name'], $path);
		$data['imagen'] = basename($_FILES['imagen']['name']);
	}

	if($data['email'] != "" && $data['firstname'] != "" && $data['lastname'] != ""){
		if(strlen($data['password']) >= 6 && $data['password'] == $data['password2']){
			$sql = "INSERT INTO users(username, password, izena, abizena, hiria, lurraldea, herrialdea, postakodea, telefonoa, irudia) VALUES (";
			$sql .= "'" . $data['email'] . "', ";
			$sql .= "'" . md5($data['password'] ). "', ";
			$sql .= "'" . $data['firstname'] . "', ";
			$sql .= "'" . $data['lastname'] . "', ";
			$sql .= "'" . $data['city'] . "', ";
			$sql .= "'" . $data['stateProv'] . "', ";
			$sql .= "'" . $data['country'] . "', ";
			$sql .= "'" . $data['postcode'] . "', ";
			$sql .= "'" . $data['telephone'] . "', ";
			$sql .= "'" . $data['imagen']. "')";
			if (!mysqli_query($conx,"$sql"))
			{
				die('Error: ' . mysqli_error());
			}
			else {
				header("Location: index.php");
			}
		}else{
			echo "Pasahitzarekin arazo bat gertatu da";
		}
	}else{
		echo "(*) duten eremu guztiak derrigorrezkoak dira";
	}
}
?>
	<div class="content">
	<br/>
	<div class="register">

		<h2>Erregistroa egin</h2>
		<br/>

		<b>Introduce la información.</b>
		<br/>
		<form action="<?php echo $_SERVER['PHP_SELF']."?action=register"; ?>" method="POST" enctype="multipart/form-data">
			<p>
				<label>Email/username*: </label>
				<input type="text" name="data[email]" placeholder="<?php echo $data['email']; ?>" />
				<?php if ($error['email']) echo '<p>', $error['email']; ?>
			<p>
			<p>
				<label>Izena*: </label>
				<input type="text" name="data[firstname]" placeholder="<?php echo $data['firstname']; ?>" />
				<?php if ($error['firstname']) echo '<p>', $error['firstname']; ?>
			<p>
			<p>
				<label>Abizena*: </label>
				<input type="text" name="data[lastname]" placeholder="<?php echo $data['lastname']; ?>" />
				<?php if ($error['lastname']) echo '<p>', $error['lastname']; ?>
			<p>
			<p>
				<label>Hiria: </label>
				<input type="text" name="data[city]" placeholder="<?php echo $data['city']; ?>" />
				<?php if ($error['city']) echo '<p>', $error['city']; ?>
			<p>
			<p>
				<label>Lurraldea: </label>
				<input type="text" name="data[stateProv]" placeholder="<?php echo $data['stateProv']; ?>" />
				<?php if ($error['stateProv']) echo '<p>', $error['stateProv']; ?>
			<p>
			<!-- // *** validation: implement a database lookup -->
			<p>
				<label>Herrialdea: </label>
				<input type="text" name="data[country]" placeholder="<?php echo $data['country']; ?>" />
				<?php if ($error['country']) echo '<p>', $error['country']; ?>
			<p>
			<p>
				<label>Postakodea: </label>
				<input type="text" name="data[postcode]" placeholder="<?php echo $data['postcode']; ?>" />
				<?php if ($error['postcode']) echo '<p>', $error['postcode']; ?>
			<p>
			<p>
				<label>Telefonoa: </label>
				<input type="text" name="data[telephone]" placeholder="<?php echo $data['telephone']; ?>" />
				<?php if ($error['telephone']) echo '<p>', $error['telephone']; ?>
			<p>
			<p>
				<label>Pasahitza (6 karaktere gutxienez)*: </label>
				<input type="password" name="data[password]" placeholder="<?php echo $data['password']; ?>" />
				<?php if ($error['password']) echo '<p>', $error['password']; ?>
			<p>
            <p>
                <label>Pasahitza errepikatu*: </label>
                <input type="password" name="data[password2]" placeholder="<?php echo $data['password2']; ?>" />
            <p>
            <p>
                <label>Irudia aukeratu (PNG.JPEG,JPG,GIF):</label>
                <input name="imagen" type="file" />
            <p>
			<p>
				<input type="reset" name="data[clear]" value="Clear" class="button"/>
				<input type="submit" name="data[submit]" value="Submit" class="button marL10"/>
			<p>
		</form>
	</div>
</div>
