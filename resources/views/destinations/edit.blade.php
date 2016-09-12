@extends('layouts.app')
@section('page-title','Edit Experience')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                     <div class="panel-heading">New Destination</div>

                    <div class="panel-body">
                     
                      @include('common.errors')
                      {!! Form::model($destination,[
                            'route' => ['destinations.update', $destination->id],
                            'class' => 'form-horizontal',
                            'method' => 'patch',
                            'id' => 'destination-form',
                            'files' => true
                          ]) !!}
                           <ul class="nav nav-tabs">
                            <li class="active"><a href="#basic-tab" data-toggle="tab">Basic</a></li>
                            <li><a href="#images-tab" data-toggle="tab">Images / Video</a></li>
                            <li><a href="#calendar-tab" data-toggle="tab">Calendar</a></li>
                            <li><a href="#settings-tab" data-toggle="tab">Settings</a></li>
                          </ul> 
                          
                          @include('destinations.fields')
                       
                      
                      
                  </div>
                </div>
            </div>
        </div>
    </div>

    @include('reservations.add_modal')

    <!-- This modal is used to display the reservation details -->
    <div class="details-modal"></div>
@endsection

@section('app-js')
<script type="text/javascript">
var body = $("body");
var destinationId = "{{$destination->id}}";
var token = "{{ csrf_token() }}";
$(function() {
  $("select.basic-multiple,select.basic-single").select2({
   theme: "bootstrap"
  });

  $("#photos").fileinput({
    uploadUrl: "/destinations/uploadImages/"+destinationId,
    uploadAsync: false,
    maxFileCount: 5,
    showCaption: false,
    allowedFileExtensions: ['png', 'jpg', 'jpeg'],
    uploadExtraData: { id: destinationId },
    extra: {id: destinationId}

  });

  $('#video-form').ajaxForm({
    target: "#video-preview"
  });
  $("#reservation-form").ajaxForm({
    resetForm: true,
    dataType: 'json',
    success: function(responseText, statusText, xhr, $form){
      var success = responseText.success;
      if(success){
        $("body").find(".modal").modal('hide');
        eModal.alert({
          message: "Reservation added.",
          size: eModal.size.sm
        });
        $('#calendar').fullCalendar('refetchEvents');
     }
    }
  });

   $('#starttime, #endtime  ').datetimepicker({
      format: 'LT'
    });

  $("div#calendar").fullCalendar({
    defaultView: 'agendaWeek',
    editable: false,
    eventSources: [
      {
        url: "/destination/"+destinationId+"/reservations",
        type: "get",
        data: {
          start: "{{ date('Y-m-d') }}",
          end: "{{ date('Y-m-d', strtotime('+20 days')) }}"
        }
      }
    ],
    dayClick: function(date, jsEvent, view) {
      $("input#res_date").attr('value',date.format('dddd D, MMMM Y')); // Used just for render the date.
      $("input#date").attr('value', date.format('Y-MM-D'));
      $("input#starttime").val(date.format('LT'));
      $("#add-reservation").modal('show');
    },
    eventDurationEditable: false,
    eventClick: function(calEvent, jsEvent, view) {
      var reservationId = calEvent.id;
      $(".details-modal").html("");
      var url = `/reservations/${reservationId}/details`;
      $('.details-modal').load(url,function(result){
        $("#reservation-details").modal('show');
        $('#starttime, #endtime  ').datetimepicker({
          format: 'LT'
        });

        $("#reservation-edit-form").ajaxForm({
          resetForm: true,
          dataType: 'json',
          success: function(responseText, statusText, xhr, $form){
            var success = responseText.success;
            if(success){
              $("body").find(".modal").modal('hide');
              eModal.alert({
                message: "Reservation added.",
                size: eModal.size.sm
              });
              $('#calendar').fullCalendar('refetchEvents');
           }
          }
        });
      });
    }
  });

  $('#add-reservation').on('hide.bs.modal', function (e) {
    $('#endtime,#starttime').val('');
  });

      
  renderCalendar();
    
    function adjustIframeHeight() {
      var $body   = $('body'),
      $iframe = $body.data('iframe.fv');
      if ($iframe) {
            // Adjust the height of iframe
            $iframe.height($body.height());
        }
    }

    //Redirect to specific tab on pagination
    // Javascript to enable link to tab
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
        renderCalendar();
    } 


    //Change destination status
    $("[name='destination-status']").bootstrapSwitch({
      onColor: 'success',
      offColor: 'danger',
      onText: 'Online',
      offText: 'OffLine',
      onSwitchChange: function(event, state){
        var id  = $(this).attr('id');
        if(state){
          DESTINATIONS.updateStatus(id,"2");
        } else {
          DESTINATIONS.updateStatus(id,"3");
        }
      }
    });


    function setCover(imageId, destinationId) {
      var data = {};
      data["image_id"] = imageId;
      data["destination_id"] = destinationId;
      data["_token"] = "{{ csrf_token() }}";
      return $.ajax({
        url: "/destination/setcover",
        type: "post",
        data: data,
        beforeSend : function(){
          $("div.destination-images").html("");
          $("div.destination-images").html('<div class="loader" style="margin: 0 auto"></div>');
        }
      });
    }
    //Destination image cover action
    var coverBtn = $(".cover-btn");
    $(body).on("click", ".cover-btn", function(){
      var imageId = $(this).attr("image-id");
      var destinationId = $(this).attr("destination-id");
      var coverResponse = setCover(imageId, destinationId);
      showCoverResponse(coverResponse);
    });

    // Change hash for page-reload
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
    })
    

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


function renderCalendar(){
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('#calendar').fullCalendar('render');
  });
}
function showCoverResponse(response){
  response.done(function(data){
    setTimeout(function(){
        $("div.destination-images").html(data);
    }, 800);
  });
}
</script>
@endsection






