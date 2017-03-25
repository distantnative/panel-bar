
var list     = $('.panelBar-widget__list');

// =============================================
//  Sortable
// =============================================
var sortable = Sortable.create(list[0], {
  onUpdate: setElements
});

// =============================================
//  On checking/unchecking
// =============================================
list.find('input').change(function(e) {
  var el     = $(this);
  var active = list.find(':checked').not(el);
  el.parent().insertAfter(active.last().parent());
  setElements();
});

// =============================================
//  Set API call
// =============================================
function setElements() {
  var data = { 'elements[]' : []};
  list.find(":checked").each(function() {
    data['elements[]'].push($(this).val());
  });
  $.post(setURL, data);
}

// =============================================
//  Reset button
// =============================================
list.prev('h2').find('a').click(function(e) {
  e.preventDefault();
  $.post($(this).attr("href"));
  location.reload();
  return false;
});
