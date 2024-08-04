var elements = $('.modal-overlay, .modal');

$('#play-btn').click(function () {
    elements.addClass('active');
});

$('.close-modal').click(function () {
    elements.removeClass('active');
});