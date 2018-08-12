$(document).ready(function() {

    /*
     * Поиск по каталогу в шапке сайта
     */
    $('#top-search > form > input[name="query"]').attr('autocomplete', 'off').keyup(function () {
        if ($(this).val().trim().length > 1) {
            $('#top-search > div').html('<div class="top-search-loader"></div>');
            $('#top-search > div > div').show();
            $('#top-search > form').ajaxSubmit({
                target: '#top-search > div > div',
                success: function() {
                    $('#top-search > div > div').removeClass('top-search-loader');
                    if($('#top-search > div > div').is(':empty')) {
                        $('#top-search > div').empty();
                    }
                }
            });
        } else {
            $('#top-search > div').empty();
        }
    });
    $('#top-search > div').on('click', 'div > span', function() {
        $('#top-search > form > input[name="query"]').val('');
        $('#top-search > div').empty();
    });

    $('.collapse > i').click(function() {
        _this = $(this);
        $(this).next().slideToggle('normal', function() {
            if (_this.hasClass('fa-minus-square-o')) {
                _this.removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
            } else {
                _this.removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
            }
            _this.next().next().slideToggle();
        });
    });

});
