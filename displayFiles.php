<?php
function displayFiles(string $dir, $niveau = 0)
{

    $names = scandir($dir);
    $regexHtml = "#.html$#";
    $regexTxt = "#.txt$#";

    foreach ($names as $name) {
        if ($name == '.' || $name == '..')
        {
            continue;
        }

        for ($i = 0; $i < $niveau; $i++) {
            echo "&emsp;&emsp;";
        }

        $route = $dir . '/' . $name;
        if (is_dir($route)) {
            $name = ucfirst($name);
            echo "<strong>$name :</strong><br>";
            ?>
            <form action="" method="post">
                <button type="submit" class="btn btn-danger" name="delete" value="<?=$route?>">Delete</button>
            </form>
            <?php
            echo "<br>";
            displayFiles($route, $niveau+1);
        } else {
            echo "<a href=$route>$name</a>";
            ?>
            <form action="" method="post">
                <button type="submit" class="btn btn-danger" name="delete" value="<?=$route?>">Delete</button>
                <?php if (preg_match($regexHtml, $route) || preg_match($regexTxt, $route)){?>
                <button type="submit" class="btn btn-info" name="edit" value="<?=$route?>">Edit</button>
                <?php } ?>
            </form>
            <?php
            echo "<br>";
        }
    }
}
