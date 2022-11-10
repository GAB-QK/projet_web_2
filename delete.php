<?php
function loadClass($class)
{
    if (str_contains($class, "Manager")) {
        require "./controllers/$class.php";
    } else {
        require "./models/$class.php";
    }
}
spl_autoload_register("loadClass");
$manager = new ArticleManager();
if ($_GET) {
    $manager->delete($_GET['id']);
}

if (str_contains($_SERVER['HTTP_REFERER'], "readAll") == TRUE) {
    echo "<script> window.location.href='readAll.php'</script>";
} else if (str_contains($_SERVER['HTTP_REFERER'], "top_article") == TRUE) {
    echo "<script> window.location.href='top_article.php'</script>";
} else {
    echo "<script> window.location.href='readAll.php'</script>";
}
