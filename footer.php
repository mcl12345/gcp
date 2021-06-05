<?php
function footer() {

  return '
  </div>
  <div id="footer"></div>
  <!-- Footer -->
  <footer class="footer-top page-footer font-small special-color-dark pt-4 bg-1" style="background-color: #303030; color: #ffffff;">

      <!-- Footer Elements -->

      <div class="container">
		<div  class="row">

        <!-- Social buttons -->
        <ul class="list-unstyled list-inline text-center">
          <li class="list-inline-item">
            <a class="btn-floating btn-fb mx-1" target="_blank" href="https://www.facebook.com/BasiliqueCathedraleSaintDenis/">
              <i class="fa fa-facebook"><img src="img/footer_img/facebook.png" class="img-rounded" /></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-tw mx-1" target="_blank" href="https://twitter.com/basiliquesdenis?lang=fr">
              <i class="fa fa-twitter"><img src="img/footer_img/twitter.png" class="img-rounded" /></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-dribbble mx-1" target="_blank" href="https://www.youtube.com/watch?v=BXlXv48HY5w">
              <i class="fa fa-dribbble"><img src="img/footer_img/youtube.png" class="img-rounded" /> </i>
            </a>
          </li>
        </ul>
        <!-- Social buttons -->
		</div>
      </div>
      <!-- Footer Elements -->

      <!-- copyleft -->
      <div class="text-center py-3"> '. date("Y").' - Official website : <a class="text-primary" target="_blank" href="http://www.saint-denis-basilique.fr/"> saint-denis-basilique.fr</a>
      </div>
      <!-- Copyright -->

    </footer>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
      if(document.getElementById("mybody").offsetHeight < 600) {
        console.log("a");
        $( "#footer" ).height( 500);
      } else {
        console.log("b");
        $( "#footer" ).height( ($( window ).height() - document.getElementById("mybody").offsetHeight) );
      }
    )};
    /*$( window ).resize(function() {
      $( "#footer" ).height( ($( window ).height()) );
    });*/
    </script>
  <!-- Footer -->';
}
?>
