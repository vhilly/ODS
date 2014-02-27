var incoming = $('#incoming').data('target');
var accepted = $('#accepted').data('target');
$('#incoming').load(incoming);
$('#accepted').load(accepted);

setInterval(function(){
  $('#incoming').load(incoming);
},5000);
$(document).ready(function() {
  $('.modal-content').click(function(){
    var target = $(this).attr('data-target');
    var url = $(this).data('content');
    if(url){
        $(target).find(".modal-body").load(url);
        $(target).find(".modal-header h4").html($(this).data('title'));
        $(target).find(".modal-footer").html('<button id="btnSave" class="btn btn-primary">Save</button>'+
       '<button data-dismiss="modal" id="modalClose" class="btn" name="yt0" type="button">Close</button>');
    }
  });

  $(document).on('click','.updateOrder',function(){
    var status = $(this).data('status_id');
    $.ajax({
      url:$(this).data('content')+$(this).data('order_id')+'&sid='+status,
      success:function(data){
          if(status==1)
            $('#incoming').load(incoming);
          $('#accepted').load(accepted);
          updateSockets(true,false);
      },
      error:function(){
        alert(this.url);
      }
    });
    return false;
  });
  $(document).on('click','.selectRider',function(){
    $('#contentModal .modal-body').load($(this).data('content')+$(this).data('order_id'));
    $('#contentModal .modal-header h4').html('Select Rider');
    $('#contentModal .modal-footer').html('');
    $('#contentModal').modal();
    return false;
  });
  $(document).on('click','.setRider',function(){
    $.ajax({
      url:$(this).data('content')+$(this).data('order_id')+'&sid='+$(this).data('status_id')+'&rid='+$(this).data('rider_id')+'&rname='+$(this).html(),
      success:function(data){
        $('#accepted').load(accepted);
        $('#contentModal').modal('hide');
        updateSockets(true,false);
      },
      error:function(){
        alert(this.url);
      }
    });
    return false;
  });
  $(document).on('click','.view',function(){
    var url=$(this).data('content')+$(this).data('order_id');
    var target=$(this).data('target');
    $(target).load(url);
    return false;
  });
  $(document).on('click','.btnCall',function(){
     var dest = $(this).data('dest');
     var cid = $(this).data('cid');
     if(confirm('Call '+dest+'')){
       var obj ={};
       obj={action:'Originate',channel:'SIP/'+dest,context:'from-local',exten:cid,async:'true',callerid:'SHAKEYS'};
       now.send_data_to_asterisk(obj);
       e.preventDefault();
     }
  });

  $('#btnShowMap').click(function(){
    return windowpop($(this).data('target'), 1000, 600);
  });
  $('#btnVerifyCard').click(function(){
    var cardNo=$('#cardNo').val(),SI= $('#orderSI').val();
    $.ajax({
      url:$(this).data('target')+cardNo,
      statusCode: {
        200: function(data) {
          if(SI.indexOf(cardNo)<0)
            $('#orderSI').val(SI+' -Check for card (#'+cardNo+')');
            $('#contentModal .modal-header h4').html('');
            $('#contentModal .modal-footer').html('');
            $('#contentModal .modal-body').html(data);
            $('#contentModal').modal();
        },
        204: function() {
         alert( "No record found" );
         $('#orderSI').val('');
        },
        500: function() {
         alert( this.url );
        }
      }
    });
  });

  $(document).on('click','.btnCardHolder',function(){
    $.ajax({
      url:$(this).data('target')+$(this).data('card_no'),
      statusCode: {
        200: function(data) {
            $('#contentModal .modal-header h4').html('&nbsp;');
            $('#contentModal .modal-footer').html('');
            $('#contentModal .modal-body').html(data);
            $('#contentModal').modal();
        },
        204: function() {
         alert( "No record found" );
        },
        500: function() {
         alert( this.url );
        }
      }
    });
  });

  $('#branch').change(function(){
    if($(this).val())
      $('.btnCategory').prop('disabled',false);
    else
      $('.btnCategory').prop('disabled',true);
    $('#menuHolder').html('');
  });


  $('#customerPhone1').change(function(){
    $.ajax({
      url:$(this).data('target')+$(this).val(),
      success:function(data){
        if(data !=''){
          $('#contentModal .modal-body').html(data);
          $('#contentModal .modal-header h4').html('Order History');
          $('#contentModal .modal-footer').html('<button class=btn data-dismiss=modal>Close</button>');
          $('#contentModal').modal();
          $('#customerName').val($('#contentModal .modal-body #customer_name').html());
          $('#customerAddress').val($('#contentModal .modal-body #customer_address').html());
          $('#customerID').val($('#contentModal .modal-body #customer_id').html());

        }else{
          $('#customerID').val('');
        }
      },
      error:function(){
        alert(this.url);
      }
    });
  });



  $('#btnPO').click(function(){
     if(!$('#customerName').val() || !$('#customerPhone1').val() || !$('#customerAddress').val()){
       alert('Please enter complete customer details');
       return false;
     }
     if(!$("#currentOrders tr").html()){
         alert('There\'s no item in the orderlist!');
         return false;
     }
     if(!$('#branch').val()){
       alert('Please select branch!');
       return false;
     }
     if(confirm('Are you sure?')){
       if($("#currentOrders tr").html()){
        var order ={bid:$('#branch').val(),bname:$('#branch option:selected').text(),remarks:$('#orderRemarks').val(),si:$('#orderSI').val(),bchange:$('#orderBillChange').val(),
         delivery_date:$('#delivery_date').val(),delivery_time:$('#delivery_time').val(),card_no:$('#cardNo').val()}
        var customer = {id:$('#customerID').val(),name:$('#customerName').val(),phone1:$('#customerPhone1').val(),address:$('#customerAddress').val(),geocode:$('#customerGeocode').val()};
        $.post($(this).data('target'), 
         { customer:customer,order:order }).done(function( data ) {
          alert(  data );
          updateOrderList();
          clearData();
          var dt=new Date();
          var d1 =  new Date( dt.getFullYear(),dt.getMonth(),dt.getDate(),dt.getHours()).getTime();
          updateSockets(true,[order.bid,d1]);
        }).fail(function(data){
          console.log(data)
        });
       }
     }
  });


  $('.btnCategory').click(function(){
    $.ajax({
      url:$(this).data('target')+$(this).data('menu_id')+'&bid='+$('#branch').val(),
      success:function(data){
       $('#menuHolder').html(data);
      },
      error:function(){
        alert(this.url);
      }
    });
   });
  $(document.body).on("click", '.itemSelect', function(){
    var header=$(this).data('prod_name');
    $.ajax({
      url:$(this).data('target')+$(this).data('prod_id'),
      success:function(data){
    $('#orderModal .modal-body').html('');
       $('#orderModal .modal-body').html(data);
       $('#orderModal .modal-header h4').html(header);
       $('#orderModal').modal();
      },
      error:function(){
        alert(this.url);
      }
    });
   });

  $(document.body).on("click", '.deleteOrder', function(){
    if(confirm('Are you sure?')){
      $.ajax({
        url:$(this).data('target')+$(this).data('order_id'),
        success:function(data){
          updateOrderList();
        },
        error:function(){
         alert(this.url);
        }
      });
    }
  });

  $(document.body).on("click", '.followUp', function(){
      $.ajax({
        url:$(this).data('target')+$(this).data('order_id'),
        success:function(data){
          $('#contentModal').modal('hide');
        },
        error:function(){
         alert(this.url);
        }
      });
  });

});
  var socket = io.connect('http://ryouko.imperium.jp:8000');

  var flag=1;
  $( document ).ajaxStart(function(){
    progress();
  });
  $( document ).ajaxStop(function(){
   flag=0;
   $('#progressBar').hide();
  });

  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
     return false;
    return true;
  }
  function windowpop(url, width, height) {
    var leftPosition, topPosition;
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    window.open(url, "map", "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + 
     leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=yes,location=no,directories=no");
  }
  function progress(){
    setTimeout(function(){
      if(flag)
        $('#progressBar').show();
    },1000);
  }
  function updateOrderList(){
    $.ajax({ url:$('#orderListHolder').data('target'),success:function(data){
       $('#orderListHolder').html(data);
    },cache:false});
  };
  function clearData(){
    $('#orderSI').val('');
    $('#branch').val('');
    $('#branch').change();
    $('#orderRemarks').val('');
    $('#orderSI').val('');
    $('#orderBillChange').val('');
    $('#customerID').val('');
    $('#customerName').val('');
    $('#customerPhone1').val('');
    $('#customerAddress').val('');
    $('#delivery_date').val('');
    $('#delivery_time').val('');
  };
  function updateSockets(monitoring,graph){
    if(monitoring)
      socket.emit('updateOrders');
    if(graph)
      socket.emit('updateSeries');//socket.emit('updateSeries',graph);
  }
  updateOrderList();
