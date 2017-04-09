
var panelBarList = $('.panelBar-widget__list');

// =============================================
//  Sortable
// =============================================
var sortable = Sortable.create(panelBarList[0], {
  onUpdate: setPanelBarElements
});

// =============================================
//  On checking/unchecking
// =============================================
panelBarList.find('input').change(function(e) {
  var el     = $(this);
  var active = panelBarList.find(':checked').not(el);

  var floats = el.siblings('.floats').find('a');
  floats.removeClass('active');
  if(el.is(':checked')) floats.first().addClass('active');

  el.parent().insertAfter(active.last().parent());
  setPanelBarElements();
});

// =============================================
//  On float setting
// =============================================
panelBarList.find('.floats > a').click(function(e) {
  e.preventDefault();
  $(this).toggleClass('active');
  $(this).siblings().removeClass('active');
  setPanelBarElements();
  return false;
});


// =============================================
//  Set API call
// =============================================
function setPanelBarElements() {
  var data = generatePanelBarConfig();
  $.post(setPanelBarURL, data);
}

function generatePanelBarConfig() {
  var data = { 'elements' : []};

  panelBarList.find(":checked").each(function() {
    data.elements.push({
      element: $(this).val(),
      float:   $(this).siblings('.floats').find('.active').data('float')
    });
  });

  return data;
}

// =============================================
//  Reset button
// =============================================
panelBarList.prev('h2').find('a').click(function(e) {
  e.preventDefault();
  $.post($(this).attr("href"));
  location.reload();
  return false;
});
