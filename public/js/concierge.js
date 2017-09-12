/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 41);
/******/ })
/************************************************************************/
/******/ ({

/***/ 41:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(42);
module.exports = __webpack_require__(43);


/***/ }),

/***/ 42:
/***/ (function(module, exports) {

/*!
 * jQuery twitter bootstrap wizard plugin
 * Examples and documentation at: http://github.com/VinceG/twitter-bootstrap-wizard
 * version 1.0
 * Requires jQuery v1.3.2 or later
 * Supports Bootstrap 2.2.x, 2.3.x, 3.0
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Authors: Vadim Vincent Gabriel (http://vadimg.com), Jason Gill (www.gilluminate.com)
 */
;(function ($) {
	var bootstrapWizardCreate = function bootstrapWizardCreate(element, options) {
		var element = $(element);
		var obj = this;

		// selector skips any 'li' elements that do not contain a child with a tab data-toggle
		var baseItemSelector = 'li:has([data-toggle="tab"])';

		// Merge options with defaults
		var $settings = $.extend({}, $.fn.bootstrapWizard.defaults, options);
		var $activeTab = null;
		var $navigation = null;

		this.rebindClick = function (selector, fn) {
			selector.unbind('click', fn).bind('click', fn);
		};

		this.fixNavigationButtons = function () {
			// Get the current active tab
			if (!$activeTab.length) {
				// Select first one
				$navigation.find('a:first').tab('show');
				$activeTab = $navigation.find(baseItemSelector + ':first');
			}

			// See if we're currently in the first/last then disable the previous and last buttons
			$($settings.previousSelector, element).toggleClass('disabled', obj.firstIndex() >= obj.currentIndex());
			$($settings.nextSelector, element).toggleClass('disabled', obj.currentIndex() >= obj.navigationLength());

			// We are unbinding and rebinding to ensure single firing and no double-click errors
			obj.rebindClick($($settings.nextSelector, element), obj.next);
			obj.rebindClick($($settings.previousSelector, element), obj.previous);
			obj.rebindClick($($settings.lastSelector, element), obj.last);
			obj.rebindClick($($settings.firstSelector, element), obj.first);

			if ($settings.onTabShow && typeof $settings.onTabShow === 'function' && $settings.onTabShow($activeTab, $navigation, obj.currentIndex()) === false) {
				return false;
			}
		};

		this.next = function (e) {

			// If we clicked the last then dont activate this
			if (element.hasClass('last')) {
				return false;
			}

			if ($settings.onNext && typeof $settings.onNext === 'function' && $settings.onNext($activeTab, $navigation, obj.nextIndex()) === false) {
				return false;
			}

			// Did we click the last button
			$index = obj.nextIndex();
			if ($index > obj.navigationLength()) {} else {
				$navigation.find(baseItemSelector + ':eq(' + $index + ') a').tab('show');
			}
		};

		this.previous = function (e) {

			// If we clicked the first then dont activate this
			if (element.hasClass('first')) {
				return false;
			}

			if ($settings.onPrevious && typeof $settings.onPrevious === 'function' && $settings.onPrevious($activeTab, $navigation, obj.previousIndex()) === false) {
				return false;
			}

			$index = obj.previousIndex();
			if ($index < 0) {} else {
				$navigation.find(baseItemSelector + ':eq(' + $index + ') a').tab('show');
			}
		};

		this.first = function (e) {
			if ($settings.onFirst && typeof $settings.onFirst === 'function' && $settings.onFirst($activeTab, $navigation, obj.firstIndex()) === false) {
				return false;
			}

			// If the element is disabled then we won't do anything
			if (element.hasClass('disabled')) {
				return false;
			}
			$navigation.find(baseItemSelector + ':eq(0) a').tab('show');
		};
		this.last = function (e) {
			if ($settings.onLast && typeof $settings.onLast === 'function' && $settings.onLast($activeTab, $navigation, obj.lastIndex()) === false) {
				return false;
			}

			// If the element is disabled then we won't do anything
			if (element.hasClass('disabled')) {
				return false;
			}
			$navigation.find(baseItemSelector + ':eq(' + obj.navigationLength() + ') a').tab('show');
		};
		this.currentIndex = function () {
			return $navigation.find(baseItemSelector).index($activeTab);
		};
		this.firstIndex = function () {
			return 0;
		};
		this.lastIndex = function () {
			return obj.navigationLength();
		};
		this.getIndex = function (e) {
			return $navigation.find(baseItemSelector).index(e);
		};
		this.nextIndex = function () {
			return $navigation.find(baseItemSelector).index($activeTab) + 1;
		};
		this.previousIndex = function () {
			return $navigation.find(baseItemSelector).index($activeTab) - 1;
		};
		this.navigationLength = function () {
			return $navigation.find(baseItemSelector).length - 1;
		};
		this.activeTab = function () {
			return $activeTab;
		};
		this.nextTab = function () {
			return $navigation.find(baseItemSelector + ':eq(' + (obj.currentIndex() + 1) + ')').length ? $navigation.find(baseItemSelector + ':eq(' + (obj.currentIndex() + 1) + ')') : null;
		};
		this.previousTab = function () {
			if (obj.currentIndex() <= 0) {
				return null;
			}
			return $navigation.find(baseItemSelector + ':eq(' + parseInt(obj.currentIndex() - 1) + ')');
		};
		this.show = function (index) {
			if (isNaN(index)) {
				return element.find(baseItemSelector + ' a[href=#' + index + ']').tab('show');
			} else {
				return element.find(baseItemSelector + ':eq(' + index + ') a').tab('show');
			}
		};
		this.disable = function (index) {
			$navigation.find(baseItemSelector + ':eq(' + index + ')').addClass('disabled');
		};
		this.enable = function (index) {
			$navigation.find(baseItemSelector + ':eq(' + index + ')').removeClass('disabled');
		};
		this.hide = function (index) {
			$navigation.find(baseItemSelector + ':eq(' + index + ')').hide();
		};
		this.display = function (index) {
			$navigation.find(baseItemSelector + ':eq(' + index + ')').show();
		};
		this.remove = function (args) {
			var $index = args[0];
			var $removeTabPane = typeof args[1] != 'undefined' ? args[1] : false;
			var $item = $navigation.find(baseItemSelector + ':eq(' + $index + ')');

			// Remove the tab pane first if needed
			if ($removeTabPane) {
				var $href = $item.find('a').attr('href');
				$($href).remove();
			}

			// Remove menu item
			$item.remove();
		};

		var innerTabClick = function innerTabClick(e) {
			// Get the index of the clicked tab
			var clickedIndex = $navigation.find(baseItemSelector).index($(e.currentTarget).parent(baseItemSelector));
			if ($settings.onTabClick && typeof $settings.onTabClick === 'function' && $settings.onTabClick($activeTab, $navigation, obj.currentIndex(), clickedIndex) === false) {
				return false;
			}
		};

		var innerTabShown = function innerTabShown(e) {
			// use shown instead of show to help prevent double firing
			$element = $(e.target).parent();
			var nextTab = $navigation.find(baseItemSelector).index($element);

			// If it's disabled then do not change
			if ($element.hasClass('disabled')) {
				return false;
			}

			if ($settings.onTabChange && typeof $settings.onTabChange === 'function' && $settings.onTabChange($activeTab, $navigation, obj.currentIndex(), nextTab) === false) {
				return false;
			}

			$activeTab = $element; // activated tab
			obj.fixNavigationButtons();
		};

		this.resetWizard = function () {

			// remove the existing handlers
			$('a[data-toggle="tab"]', $navigation).off('click', innerTabClick);
			$('a[data-toggle="tab"]', $navigation).off('shown shown.bs.tab', innerTabShown);

			// reset elements based on current state of the DOM
			$navigation = element.find('ul:first', element);
			$activeTab = $navigation.find(baseItemSelector + '.active', element);

			// re-add handlers
			$('a[data-toggle="tab"]', $navigation).on('click', innerTabClick);
			$('a[data-toggle="tab"]', $navigation).on('shown shown.bs.tab', innerTabShown);

			obj.fixNavigationButtons();
		};

		$navigation = element.find('ul:first', element);
		$activeTab = $navigation.find(baseItemSelector + '.active', element);

		if (!$navigation.hasClass($settings.tabClass)) {
			$navigation.addClass($settings.tabClass);
		}

		// Load onInit
		if ($settings.onInit && typeof $settings.onInit === 'function') {
			$settings.onInit($activeTab, $navigation, 0);
		}

		// Load onShow
		if ($settings.onShow && typeof $settings.onShow === 'function') {
			$settings.onShow($activeTab, $navigation, obj.nextIndex());
		}

		$('a[data-toggle="tab"]', $navigation).on('click', innerTabClick);

		// attach to both shown and shown.bs.tab to support Bootstrap versions 2.3.2 and 3.0.0
		$('a[data-toggle="tab"]', $navigation).on('shown shown.bs.tab', innerTabShown);
	};
	$.fn.bootstrapWizard = function (options) {
		//expose methods
		if (typeof options == 'string') {
			var args = Array.prototype.slice.call(arguments, 1);
			if (args.length === 1) {
				args.toString();
			}
			return this.data('bootstrapWizard')[options](args);
		}
		return this.each(function (index) {
			var element = $(this);
			// Return early if this element already has a plugin instance
			if (element.data('bootstrapWizard')) return;
			// pass options to plugin constructor
			var wizard = new bootstrapWizardCreate(element, options);
			// Store plugin object in this element's data
			element.data('bootstrapWizard', wizard);
			// and then trigger initial change
			wizard.fixNavigationButtons();
		});
	};

	// expose options
	$.fn.bootstrapWizard.defaults = {
		tabClass: 'nav nav-pills',
		nextSelector: '.wizard li.next',
		previousSelector: '.wizard li.previous',
		firstSelector: '.wizard li.first',
		lastSelector: '.wizard li.last',
		onShow: null,
		onInit: null,
		onNext: null,
		onPrevious: null,
		onLast: null,
		onFirst: null,
		onTabChange: null,
		onTabClick: null,
		onTabShow: null
	};
})(jQuery);

/***/ }),

/***/ 43:
/***/ (function(module, exports) {

if (typeof MS == 'undefined') {
    MS = {};
}

(function ($$, $) {
    console.log('ddd');
    // initiate validator
    var _options = {
        wizardSelector: '.wizard-card',
        formSelector: '.wizard-card form',
        wizardNavigationSelector: '.wizard-card .wizard-navigation',
        wizardStepsSelector: '.wizard-step',
        validatorOptions: {}
    };

    // initiate validator
    var $_validator = null;

    // Wizard Initialization
    $(_options.wizardSelector).bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',

        onNext: function onNext(tab, navigation, index) {
            var toNextStep = false;
            var tabPane = document.querySelectorAll('.tab-content .tab-pane');
            var domain = tabPane[index - 1].dataset.tab;

            if (domain === 'profile') {
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
            if (!$valid) {
                $_validator.focusInvalid();
                return false;
            }

            return toNextStep;
        },

        onPrevious: function onPrevious(tab, navigation, index) {
            console.log('onNext', tab);
        },

        onInit: function onInit(tab, navigation, index) {
            // console.log(tab, navigation, index);
            //check number of tabs and fill the entire row
            var $total = navigation.find('li').length;
            $width = 100 / $total;
            var $wizard = navigation.closest(_options.wizardSelector);

            $display_width = $(document).width();

            if ($display_width < 600 && $total > 3) {
                $width = 50;
            }

            navigation.find('li').css('width', $width + '%');
            $first_li = navigation.find('li:first-child a').html();
            $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
            $(_options.wizardNavigationSelector).append($moving_div);
            refreshAnimation($wizard, index);
            $('.moving-tab').css('transition', 'transform 0s');
        },

        onTabClick: function onTabClick(tab, navigation, index) {

            var $valid = $(_options.formSelector).valid();

            if (!$valid) {
                return false;
            } else {
                return true;
            }
        },

        onTabShow: function onTabShow(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index + 1;

            var $wizard = navigation.closest(_options.wizardSelector);

            // If it's the last tab then hide the last button and show the finish instead
            if ($current >= $total) {
                $($wizard).find('.btn-next').hide();
                $($wizard).find('.btn-finish').show();
            } else {
                $($wizard).find('.btn-next').show();
                $($wizard).find('.btn-finish').hide();
            }

            button_text = navigation.find('li:nth-child(' + $current + ') a').html();

            setTimeout(function () {
                $('.moving-tab').text(button_text);
            }, 150);

            var checkbox = $('.footer-checkbox');

            if (!index == 0) {
                $(checkbox).css({
                    'opacity': '0',
                    'visibility': 'hidden',
                    'position': 'absolute'
                });
            } else {
                $(checkbox).css({
                    'opacity': '1',
                    'visibility': 'visible'
                });
            }

            refreshAnimation($wizard, index);
        }
    });

    // Prepare the preview for profile picture
    $("#wizard-picture").change(function () {
        readURL(this);
    });

    $('[data-toggle="wizard-radio"]').click(function () {
        wizard = $(this).closest(wizardSelector);
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked', 'true');
    });

    $('[data-toggle="wizard-checkbox"]').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).find('[type="checkbox"]').removeAttr('checked');
        } else {
            $(this).addClass('active');
            $(this).find('[type="checkbox"]').attr('checked', 'true');
        }
    });

    $('.set-full-height').css('height', 'auto');

    // Function to show image before upload
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function refreshAnimation($wizard, index) {
        total_steps = $wizard.find(_options.wizardStepsSelector).length;

        move_distance = $wizard.width() / total_steps;

        step_width = move_distance;
        move_distance *= index;

        $wizard.find('.moving-tab').css('width', step_width);
        $('.moving-tab').css({
            'transform': 'translate3d(' + move_distance + 'px, 0, 0)',
            'transition': 'all 0.3s ease-out'

        });
    }

    function debounce(func, wait, immediate) {
        var timeout;
        return function () {
            var context = this,
                args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                timeout = null;
                if (!immediate) func.apply(context, args);
            }, wait);
            if (immediate && !timeout) func.apply(context, args);
        };
    };

    $(window).resize(function () {
        $(_options.wizardSelector).each(function () {
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
    };
})(MS.ConciergeWizard = {}, jQuery);

/***/ })

/******/ });