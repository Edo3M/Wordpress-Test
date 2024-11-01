"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _jquery = _interopRequireDefault(require("jquery"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Search =
/*#__PURE__*/
function () {
  // 1. describe and create/initiate our object
  function Search() {
    _classCallCheck(this, Search);

    this.addSearchHTML();
    this.resultsDiv = (0, _jquery["default"])("#search-overlay__results");
    this.openButton = (0, _jquery["default"])(".js-search-trigger");
    this.closeButton = (0, _jquery["default"])(".search-overlay__close");
    this.searchOverlay = (0, _jquery["default"])(".search-overlay");
    this.searchField = (0, _jquery["default"])("#search-term");
    this.events();
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
  } // 2. events


  _createClass(Search, [{
    key: "events",
    value: function events() {
      this.openButton.on("click", this.openOverlay.bind(this));
      this.closeButton.on("click", this.closeOverlay.bind(this));
      (0, _jquery["default"])(document).on("keydown", this.keyPressDispatcher.bind(this));
      this.searchField.on("keyup", this.typingLogic.bind(this));
    } // 3. methods (function, action...)

  }, {
    key: "typingLogic",
    value: function typingLogic() {
      if (this.searchField.val() != this.previousValue) {
        clearTimeout(this.typingTimer);

        if (this.searchField.val()) {
          if (!this.isSpinnerVisible) {
            this.resultsDiv.html('<div class="spinner-loader"></div>');
            this.isSpinnerVisible = true;
          }

          this.typingTimer = setTimeout(this.getResults.bind(this), 750);
        } else {
          this.resultsDiv.html('');
          this.isSpinnerVisible = false;
        }
      }

      this.previousValue = this.searchField.val();
    }
  }, {
    key: "getResults",
    value: function getResults() {
      var _this = this;

      _jquery["default"].when(_jquery["default"].getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()), _jquery["default"].getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val())).then(function (posts, pages) {
        var combineResults = posts[0].concat(pages[0]);

        _this.resultsDiv.html("\n        <h2 class=\"search-overlay__section-title\">General Information</h2>\n        ".concat(combineResults.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search</p>', "\n          ").concat(combineResults.map(function (item) {
          return "<li><a href=\"".concat(item.link, "\">").concat(item.title.rendered, "</a> ").concat(item.type == 'post' ? "by ".concat(item.authorName) : '', "</li>");
        }).join(''), "\n        ").concat(combineResults.length ? '</ul>' : '', "\n      "));

        _this.isSpinnerVisible = false;
      }, function () {
        _this.resultsDiv.html('<p>Unexpected error, please try again.</p>');
      });
    }
  }, {
    key: "keyPressDispatcher",
    value: function keyPressDispatcher(e) {
      if (e.keyCode == 83 && !this.isOverlayOpen && !(0, _jquery["default"])("input", "textarea").is(':focus')) {
        this.openOverlay();
      }

      if (e.keyCode == 27 && this.isOverlayOpen) {
        this.closeOverlay();
      }
    }
  }, {
    key: "openOverlay",
    value: function openOverlay() {
      var _this2 = this;

      this.searchOverlay.addClass("search-overlay--active");
      (0, _jquery["default"])("body").addClass("body-no-scroll");
      this.searchField.val('');
      setTimeout(function () {
        return _this2.searchField.focus();
      }, 301);
      this.isOverlayOpen = true;
      console.log("open method run");
    }
  }, {
    key: "closeOverlay",
    value: function closeOverlay() {
      this.searchOverlay.removeClass("search-overlay--active");
      (0, _jquery["default"])("body").removeClass("body-no-scroll");
      this.isOverlayOpen = false;
      console.log("close method run");
    }
  }, {
    key: "addSearchHTML",
    value: function addSearchHTML() {
      (0, _jquery["default"])("body").append("\n      <div class=\"search-overlay\">\n        <div class=\"search-overlay__top\">\n          <div class=\"container\">\n            <i class=\"fa fa-search search-overlay__icon\" aria-hidden=\"true\"></i>\n            <input type=\"text\" class=\"search-term\" placeholder=\"What are you looking for?\" id=\"search-term\" autocomplete=\"off\">\n            <i class=\"fa fa-window-close search-overlay__close\" aria-hidden=\"true\"></i>\n          </div>\n        </div>\n        <div class=\"container\">\n          <div id=\"search-overlay__results\"></div>\n        </div>\n      </div>\n    ");
    }
  }]);

  return Search;
}();

var _default = Search;
exports["default"] = _default;