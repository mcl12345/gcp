<?php

include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

echo '<div class="container">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="img/Basilique1.jpg" alt="Basilique1" style="width:100%;">
      </div>

      <div class="item">
        <img src="img/Basilique2.jpg" alt="Basilique2" style="width:100%;">
      </div>

      <div class="item">
        <img src="img/Basilique3.jpg" alt="Basilique3" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>';

echo footer();

echo '</body>
</html>';

?>
