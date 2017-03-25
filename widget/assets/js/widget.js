var list     = $('.panelBar-widget__list');
var el       = document.getElementById('panelBar-widget-list');
var sortable = Sortable.create(el, {
  onUpdate: function (evt) {
		setElements();
	}
});


list.prev('h2').find('a').click(function(e) {
  e.preventDefault();
  $.post($(this).attr("href"));
  location.reload();
  return false;
});

list.find('input[type="checkbox"]').change(function(e) {
  var active = list.find(':checked').not($(this));
  $(this).parent().insertAfter(active.last().parent());
  setElements();
});

function setElements() {
  var data = { 'elements[]' : []};
  list.find(":checked").each(function() {
    data['elements[]'].push($(this).val());
  });
  $.post(setURL, data);
}
