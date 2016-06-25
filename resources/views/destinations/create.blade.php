@extends('layouts.app')
@section('page-title','Create Experience')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                     <div class="panel-heading">New Destination</div>

                    <div class="panel-body">
                     
                      @include('common.errors')
                      {!! Form::open([
                            'route' => 'destinations.store',
                            'class' => 'form-horizontal',
                            'method' => 'POST',
                            'id' => 'destination-form'
                          ]) !!}
                           <ul class="nav nav-tabs">
                            <li class="active"><a href="#basic-tab" data-toggle="tab">Bacis</a></li>
                            <li><a href="#images-tab" data-toggle="tab">Images / Video</a></li>
                          </ul>
                          
                          @include('destinations.fields')
                       
                      {!! Form::close() !!}
                      
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('app-js')
<script type="text/javascript">
$(function() {
  $("select.basic-multiple,select.basic-single").select2({
   theme: "bootstrap"
  });

  $("#photos").fileinput({showCaption: false});

    function adjustIframeHeight() {
      var $body   = $('body'),
      $iframe = $body.data('iframe.fv');
      if ($iframe) {
            // Adjust the height of iframe
            $iframe.height($body.height());
        }
    }

    $('#destination-form')
    .formValidation({
      framework: 'bootstrap',
      icon: {
        //valid: 'glyphicon glyphicon-ok',
        //invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },excluded: ':disabled',})
.bootstrapWizard({
  tabClass: 'nav nav-tabs',
  onTabClick: function(tab, navigation, index) {
    return validateTab(index);
  },
  onNext: function(tab, navigation, index) {
    var numTabs    = $('#destination-form').find('.tab-pane').length,
    isValidTab = validateTab(index - 1);
    if (!isValidTab) {
      return false;
    }

    if (index === numTabs) {
      $('#destination-form').formValidation('defaultSubmit');
    }

    return true;
  },
  onPrevious: function(tab, navigation, index) {
    return validateTab(index + 1);
  },
  onTabShow: function(tab, navigation, index) {
    // Update the label of Next button when we are at the last tab
    var numTabs = $('#destination-form').find('.tab-pane').length;
    $('#destination-form')
      .find('.next')
      .removeClass('disabled')    // Enable the Next button
      .find('a')
      .html(index === numTabs - 1 ? 'Save' : 'Next');

      adjustIframeHeight();
  }
});

function validateTab(index) {
        var fv   = $('#destination-form').data('formValidation'), // FormValidation instance
            // The current tab
            $tab = $('#destination-form').find('.tab-pane').eq(index);

        // Validate the container
        fv.validateContainer($tab);

        var isValidStep = fv.isValidContainer($tab);
        if (isValidStep === false || isValidStep === null) {
            // Do not jump to the target tab
            return false;
        }

        return true;
    }
});
</script>
@endsection






