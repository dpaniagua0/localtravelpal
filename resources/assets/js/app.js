/**
 * Created by dpaniagua0 on 5/20/16.
 */
window.$ = window.jQuery = require('jquery')
require('bootstrap-sass');

var APP = APP || {};

// IIFE - Immediately Invoked Function Expression
(function($, window, document) {

    // The $ is now locally scoped 
    // Listen for the jQuery ready event on the document
    $(function() {
        
        $('[data-toggle="tooltip"]').tooltip();
    
        APP.confirm();
    
    });


    

    APP.confirm = function(){
        var btn = $(".confirm-btn");
        var title = $(btn).attr("data-title");
        var message = $(btn).attr("data-message");
        var continueEvent = false;
        $(btn).on("click", function(e){
            var url = $(this).attr("href");
            if(!continueEvent) {
                e.preventDefault();
            }
            eModal.confirm(message, title)
                .then(
                    function(){
                        window.location.replace(url);
                    },
                    function(){
                        return false;
                    });
        });
    };


    APP.loadModal = function(options){
        var settings = $.extend({
            url: "",
            target: ""
        }, options);
        var url = settings.url;
        var target = settings.target;
        try {
            if(!url) throw "Error: Empty URL you must specify the remote url.";
            if(!target) throw "Error: No target defined."
            $.get(url, function(data){
                $(target).find(".modal-body").html(data);
                if($(target).find("form")){
                    var form = $(target).find("form.ajax-form");
                    $(form).ajaxForm({
                        type: "POST",
                        dataType: "JSON",
                        error: function(response){
                            var errors = eval(response["responseJSON"]);
                            $(form).find(".form-group").removeClass("has-error");
                            $(form).find(".help-block").html("");
                            $.each(errors, function(k,v){
                                var container = $(form).find(`[name='${k}']`).parent();
                                $(container).addClass("has-error");
                                $(container).find(".help-block").html(`<strong>${v}</strong>`);
                            });
                        },
                        success: function(response){
                            var success = eval(response);
                            if($(target).find(".response")){
                                $(target).find(".response").html(`<p class="bg-${success.status} text-center hide-alert"><strong>${success.message}</strong></p>`);
                            }
                        }
                    });
                }
                $(target).modal('show');
            });
        } catch(err){
            eModal.alert(err);
        }
    };


}(window.jQuery, window, document));
// The global jQuery object is passed as a parameter

