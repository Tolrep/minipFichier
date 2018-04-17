<?php include('inc/head.php');
include('displayFiles.php');

if (isset($_POST['delete'])) {
    if (is_dir($_POST['delete'])) {
        if(count(scandir($_POST['delete']))<=2) {
            rmdir($_POST['delete']);
            header('location:index.php');
            die;
        }else {
            echo "Impossible de supprimer un dossier non-vide";
        }
    }else {
        unlink($_POST['delete']);
        header('location:index.php');
        die;
    }
}

if (isset($_POST['edit'])) {
    $content = file_get_contents($_POST['edit']);
}

if (isset($_POST['modification'])) {
    $file = fopen($_POST['route'], 'w');
    fwrite($file, $_POST['modification']);
    fclose($file);
    $message = "File has been modify!<br><br>";
}

if ($message){
    echo $message;
}
$dir = opendir("files");
displayFiles("files");

if (isset($_POST['edit'])) {?>
    <form method="post" action="">
        <textarea class="content" name="modification"><?=$content?></textarea>
        <input type="hidden" name="route" value="<?=$_POST['edit']?>">
        <input type="submit" class="btn btn-default" value="Edit">
    </form>
<?php }

closedir($dir);
include('inc/foot.php');