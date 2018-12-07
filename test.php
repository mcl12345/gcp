<?php

include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

echo "<form action='test.php' method='post'>
          <input type='text' name='test' />
          <input type='submit' value='Envoyer' />
      </form>";

if (isset($_POST["test"])) {
    echo $_POST["test"];
}

echo footer();

echo '</body>
</html>';

?>
