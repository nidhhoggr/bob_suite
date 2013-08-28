
$(document).ready(function() {
  $('ul.add_validator').before('<a class="show-add-links" href="#show-add-links">Add a validator to...</a>');
  $('ul.add_validator').hide();
  $('a.show-add-links').click(function() {
    $(this).siblings('ul.add_validator').toggle();
  });
});
