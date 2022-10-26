<form method="post" action="form.php" enctype="multipart/form-data">
<input type="file" name="avatar" id="imageUpload0"/>;
<input type="submit"></input></form>;

<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){ 
    $uploadDir = 'public/uploads/';
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpg','jpeg','png'];
    $maxFileSize = 1000000;
    move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);

    // Je sécurise et effectue mes tests

    if( (!in_array($extension, $authorizedExtensions))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
    }

    if( file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
    {
    $errors[] = "Votre fichier doit faire moins d'1M !";
    }

    echo '<img src="'.$uploadFile.'" alt="texte de remplacement" height="600" width="600">';
}


