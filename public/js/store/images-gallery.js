!function(i){var t={};function e(n){if(t[n])return t[n].exports;var s=t[n]={i:n,l:!1,exports:{}};return i[n].call(s.exports,s,s.exports,e),s.l=!0,s.exports}e.m=i,e.c=t,e.d=function(i,t,n){e.o(i,t)||Object.defineProperty(i,t,{configurable:!1,enumerable:!0,get:n})},e.n=function(i){var t=i&&i.__esModule?function(){return i.default}:function(){return i};return e.d(t,"a",t),t},e.o=function(i,t){return Object.prototype.hasOwnProperty.call(i,t)},e.p="/",e(e.s=26)}({26:function(i,t,e){i.exports=e("6gLr")},"6gLr":function(i,t,e){var n;void 0===(n=function(){return{load:function(){new Vue({el:"#gallery",data:{$gallery:null,$nextButton:null,$previousButton:null,$images:null,index:0,min:0,max:0},methods:{initialize:function(){this.$gallery=$(this.$el),this.$nextButton=this.$gallery.find(".next").first(),this.$previousButton=this.$gallery.find(".previous").first(),this.$images=this.$gallery.find(".image"),this.index=0,this.max=this.$images.length,this.$images.eq(this.index).addClass("active"),this.onGalleryHover(),this.onNextClick(),this.onPreviousClick()},onNextClick:function(){var i=null,t=null;this.$nextButton.click($.proxy(function(){this.index+1<this.max?(i=this.$images.eq(this.index),t=this.$images.eq(this.index+1),i.removeClass("active"),t.addClass("active"),this.index++):(i=this.$images.eq(this.index),t=this.$images.eq(0),i.removeClass("active"),t.addClass("active"),this.index=0)},this))},onPreviousClick:function(){var i=null,t=null;this.$previousButton.click($.proxy(function(){this.index-1>=this.min?(i=this.$images.eq(this.index),t=this.$images.eq(this.index-1),i.removeClass("active"),t.addClass("active"),this.index--):(i=this.$images.eq(this.index),t=this.$images.eq(this.max-1),i.removeClass("active"),t.addClass("active"),this.index=this.max-1)},this))},onGalleryHover:function(){this.$gallery.hover(function(){$(this).addClass("active")},function(){$(this).removeClass("active")})}},mounted:function(){this.initialize()}})}}}.call(t,e,t,i))||(i.exports=n)}});