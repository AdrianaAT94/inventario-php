<div class="navbar navbar-default navbar-fixed-bottom" >
    <div class="container">
   </div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
        $menu = $('.nav.navbar-nav').find('li.desplegable');

        $menu.click(function() {
        	var style = $(this).children('ul.desplegable').css('display');
        	if(style=="none"){
	            $(this).children('ul.desplegable').stop();
	            $(this).children('ul.desplegable').slideDown();
	            $(this).children('ul.desplegable').css('display','block');
        	}
        	else {
	            $(this).children('ul.desplegable').stop();
	            $(this).children('ul.desplegable').slideUp();
        	}
       });
    });
  </script>