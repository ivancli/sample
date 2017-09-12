if (typeof MS == 'undefined') { MS = {}; }

(function ($$, $) {
    console.log('ddd');
    // initiate validator
    var _options = {
        wizardSelector: '.wizard-card',
        formSelector: '.wizard-card form',
        wizardNavigationSelector: '.wizard-card .wizard-navigation',
        wizardStepsSelector: '.wizard-step',
        validatorOptions: {},
    };

    // initiate validator
    var $_validator = null;

    // Wizard Initialization
    $(_options.wizardSelector).bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',

        onNext: function(tab, navigation, index) {
            let toNextStep = false;
            const tabPane = document.querySelectorAll('.tab-content .tab-pane');
            const domain = tabPane[index-1].dataset.tab;

            if(domain === 'profile') {
                console.log('handle the user registration logic here');
                toNextStep = true;
            } else if (domain === 'receipt') {
                console.log('handle the receipt upload login here');
                toNextStep = true;
            } else if (domain === 'coupon') {
                console.log('handle the coupon redemption login here');
                toNextStep = true;
            }

            var $valid = $(_options.formSelector).valid();
            if(!$valid) {
                $_validator.focusInvalid();
                return false;
            }

            return toNextStep;
        },

        onPrevious: function (tab, navigation, index) {
            console.log('onNext', tab);
        },

        onInit : function(tab, navigation, index){
            // console.log(tab, navigation, index);
            //check number of tabs and fill the entire row
            var $total = navigation.find('li').length;
            $width = 100/$total;
            var $wizard = navigation.closest(_options.wizardSelector);

            $display_width = $(document).width();

            if($display_width < 600 && $total > 3){
                $width = 50;
            }

            navigation.find('li').css('width',$width + '%');
            $first_li = navigation.find('li:first-child a').html();
            $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
            $(_options.wizardNavigationSelector).append($moving_div);
            refreshAnimation($wizard, index);
            $('.moving-tab').css('transition','transform 0s');
        },

        onTabClick : function(tab, navigation, index){

            var $valid = $(_options.formSelector).valid();

            if(!$valid){
                return false;
            } else {
                return true;
            }
        },

        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;

            var $wizard = navigation.closest(_options.wizardSelector);

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $($wizard).find('.btn-next').hide();
                $($wizard).find('.btn-finish').show();
            } else {
                $($wizard).find('.btn-next').show();
                $($wizard).find('.btn-finish').hide();
            }

            button_text = navigation.find('li:nth-child(' + $current + ') a').html();

            setTimeout(function(){
                $('.moving-tab').text(button_text);
            }, 150);

            var checkbox = $('.footer-checkbox');

            if( !index == 0 ){
                $(checkbox).css({
                    'opacity':'0',
                    'visibility':'hidden',
                    'position':'absolute'
                });
            } else {
                $(checkbox).css({
                    'opacity':'1',
                    'visibility':'visible'
                });
            }

            refreshAnimation($wizard, index);
        }
    });

    // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
        readURL(this);
    });

    $('[data-toggle="wizard-radio"]').click(function(){
        wizard = $(this).closest(wizardSelector);
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked','true');
    });

    $('[data-toggle="wizard-checkbox"]').click(function(){
        if( $(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('[type="checkbox"]').removeAttr('checked');
        } else {
            $(this).addClass('active');
            $(this).find('[type="checkbox"]').attr('checked','true');
        }
    });

    $('.set-full-height').css('height', 'auto');

    // Function to show image before upload
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function refreshAnimation($wizard, index){
        total_steps = $wizard.find(_options.wizardStepsSelector).length;

        move_distance = $wizard.width() / total_steps;

        step_width = move_distance;
        move_distance *= index;

        $wizard.find('.moving-tab').css('width', step_width);
        $('.moving-tab').css({
            'transform':'translate3d(' + move_distance + 'px, 0, 0)',
            'transition': 'all 0.3s ease-out'

        });
    }

    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            }, wait);
            if (immediate && !timeout) func.apply(context, args);
        };
    };

    $(window).resize(function(){
        $(_options.wizardSelector).each(function(){
            $wizard = $(this);
            index = $wizard.bootstrapWizard('currentIndex');
            refreshAnimation($wizard, index);

            $('.moving-tab').css({
                'transition': 'transform 0s'
            });
        });
    });

    $$.init = function (options) {
        _options = $.extend(_options, options);

        // Code for the Validator
        $_validator = $(_options.formSelector).validate(_options.validatorOptions);
    }
}(MS.ConciergeWizard = {}, jQuery));
























