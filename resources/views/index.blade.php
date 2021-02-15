@extends('layouts.app')
@section('content')

<div id="app">
    <div class="gap2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row merged20" id="page-contents">

                                                               
                                <div class="col-lg-8">
                                    <div class="central-meta">
                                        <div class="title-block">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="align-left">
                                                        <h5>Books</h5>
                                                    </div>
                                                </div>
                                               <div class="col-lg-6">
                                                    <div class="row merged20">
                                                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                                                        <div class="col-lg-4 col-lg-4 col-sm-4">
                                                        <input type="hidden" value="@if(isset(auth()->user()->id)){{auth()->user()->id}} @endif" id="user_id"/>
                                                      </div>
                                                        <div class="col-lg-4 col-lg-4 col-sm-4">
                                                        <form>

                                                           <select class="form-control" id="book_sort">
                                                            <option value="relevance">Sort By</option>
                                                            <option value="newest">Newest</option>
                                                            
                                                           </select>
                                                        </form>
                                                        </div>
      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- title block -->
                                    <div class="central-meta padding30"  >
                                    <div class="row  " id="left">
                                        @if(!isset($error) && !empty($result))
                                        @foreach($result['items'] as $item)

                                           <div class="col-md-3 mb-2 listitems"  book="{{$item['id']}}" id="">
                                            <a href="#" id="" class="close2"></a>
                                            <input type="hidden" value="{{json_encode($item)}}"/>
                                            <div class="card p-2" >
                                                <img style="height:30vh; padding: 10px;"src="{{$item['volumeInfo']['imageLinks']['thumbnail']}}">

                                                <h6 class="tube-title p-2"><a href="#" @click="showModal({{json_encode($item['id'])}})">{{substr($item['volumeInfo']['title'],0,20)}}</a></h6>
                                                 
                                                 <!-- use the modal component, pass in the prop -->
                                                   <modal :id="{{json_encode($item['id'])}}" v-show="openedModal === {{json_encode($item['id'])}}" @close="openedModal = false">
                                                    <img style="height:40vh; padding: 10px;" slot="img" src="{{$item['volumeInfo']['imageLinks']['thumbnail']}}">
                                                     <h3 slot="header">{{$item['volumeInfo']['title']}}</h3>
                                                      <p slot="body">@if(isset($item['volumeInfo']['subtitle'])) {{$item['volumeInfo']['subtitle']}}@endif</p>
                                                      <span slot="author">@if(isset($item['volumeInfo']['authors'])) {{implode(',',$item['volumeInfo']['authors'])}}@endif</span>
                                                       <span slot="price">@if(isset($item['saleInfo']['listPrice'])) {{$item['saleInfo']['listPrice']['amount']}}@else {{$item['saleInfo']['saleability']}} @endif </span>
                                                        <span slot="availablity">@if(isset($item['accessInfo']['epub']['isAvailable']) && $item['accessInfo']['epub']['isAvailable']==1) Yes @else No @endif</span>
                                                         <a onclick="window.open(this.href); return false;"href="@if(isset($item['volumeInfo']['previewLink'])) {{$item['volumeInfo']['previewLink']}}@endif" slot="link">Preview Link</a>
                                                   </modal>
                                            </div>

                                        </div>
                                        @endforeach
                                        @endif

                                </div>
                                    </div>
                                        <div class="lodmore" style="background: #fff;">
                                   
                                           <div class="errors text-center" style="width: 100%;"></div>
                                            <div class="ajax-load text-center" style="width: 100%; display: none;">
                                            <p><img src="http://localhost/Freebettors/images/loader.gif"></p>
                                             </div>
                                        </div>
                                    </div>

                                <div class="col-lg-4">
                                    <aside class="sidebar static left">
                                            <div class="widget stick-widget">
                                            <div class="row" style="border-bottom: 1px solid #e6ecf5;">
                                                <div class="col-lg-7">
                                                    <div class="align-left">
                                                      <h5 class="widget-title">Userlist</h5>
                                                    </div>
                                                </div>
                                               <div class="col-lg-4 p-2">
                                                  <!-- <form>
                                                        <select class="form-control" id="list_sort">
                                                            <option>Sort By</option>
                                                            <option value="name">Name</option>
                                                            <option value="Authors">Authors</option>
                                                           </select>
                                                        </form> -->
                                                        </div>
                                                    </div>
                                                 
                                                    <p class="p-2">Drag the book and drop here for add your personal list.</p>
                                                    <div class="col-lg-12">
                                                    <div class="row ui-widget-header connectedSortable pt-2" id="right" >
                                                         @if(!empty($userlist))
                                                         @php $i=0; @endphp
                                                        @foreach($userlist as $item)
                                                        
                                                          @if(!empty($item['book_data']))
                                                          <?php
                                                         $data=json_decode($item['book_data'],true);
                                                         ?>
                                                      <div class="col-lg-6 mb-2 listitems" book="{{$data['id']}}" id="{{$i}}" >
                                                        <a href="#" class="close2" id="{{$item['id']}}"><img width="60" src="{{url('images/x2.png')}}"></a>
                                                       <div class="card p-2" >
                                                                <img style="height:30vh; padding: 10px;" src="{{$data['volumeInfo']['imageLinks']['smallThumbnail']}}">

                                                                <h6 class="tube-title p-2"><a href="#" @click="showModal({{json_encode($data['id'])}})">{{substr($data['volumeInfo']['title'],0,20)}}</a></h6>
                                                 
                                                               <!-- use the modal component, pass in the prop -->
                                                                 <modal :id="{{json_encode($data['id'])}}" v-show="openedModal === {{json_encode($data['id'])}}" @close="openedModal = false">
                                                                  <img style="height:40vh; padding: 10px;" slot="img" src="{{$data['volumeInfo']['imageLinks']['thumbnail']}}">
                                                                   <h3 slot="header">{{$data['volumeInfo']['title']}}</h3>
                                                                    <p slot="body">@if(isset($data['volumeInfo']['subtitle'])) {{$data['volumeInfo']['subtitle']}}@endif</p>
                                                                    <span slot="author">@if(isset($data['volumeInfo']['authors'])) {{implode(',',$data['volumeInfo']['authors'])}}@endif</span>
                                                                     <span slot="price">@if(isset($data['saleInfo']['listPrice'])) {{$data['saleInfo']['listPrice']['amount']}}@else {{$data['saleInfo']['saleability']}} @endif </span>
                                                                      <span slot="availablity">@if(isset($data['accessInfo']['epub']['isAvailable']) && $data['accessInfo']['epub']['isAvailable']==1) Yes @else No @endif</span>
                                                                       <a onclick="window.open(this.href); return false;"href="@if(isset($data['volumeInfo']['previewLink'])) {{$data['volumeInfo']['previewLink']}}@endif" slot="link">Preview Link</a>
                                                                 </modal>
                                                            </div>

                                                        
                                                        </div>
                                                        @endif
                                                         @php $i++; @endphp
                                                        @endforeach
                                                        @endif
                                                       
                                                                                                                                                               
                                                        
                                                     
                                                    </div>
                                                </div>
                                                </div>
                                             </aside>   
                                        </div>
                                </div>  
                            </div>  
                        </div>
                    </div>
                </div>

</div>

 <script>


    $(function() {


    $('body').mouseleave(function()
    {
    $(document).trigger("mouseup");
    });
    // for drag drop action script////
        $( "#left, #right" ).sortable({
            connectWith: ".connectedSortable",
            receive: function(event,ui){
                 console.log("old ui id = "+ui.sender.attr("id")+" new ul id = "+this.id+" li id "+$(ui.item).attr("id"));  
                 ui.item.removeClass('col-md-3');  
                // alert( ui.item.attr('class'));               
                 ui.item.addClass('col-lg-6'); 

                 ui.item.children('.close2').html('<img width="60" src="{{url("images/x2.png")}}">');                
                 //if(ui.sender.attr("id") != this.id)
                 //{  
                 var order = $('#right').children().get().map(function(el,index) {
                  return index;
                }).join(",");
                
                    //Your ajax call will come here
                var baseurl=$('#url').val();
                $.ajax({
                    type: "POST",
                    url: baseurl+"/addbook", 
                    data: {"_token":$('#token').val(),sort:'',order:order,book_data:ui.item.children('input').val(), book_id: ui.item.attr("book"),  user_id:$('#user_id').val() }
                }).done(function( res ) {
                 if(res=='3A'){
                Swal.fire({
                  title: 'This Book already added',
                  animation: false,
                  customClass: 'animated bounceIn',
                  confirmButtonClass: 'btn btn-primary confrim',
                  buttonsStyling: false,
                });
                  ui.item.css("position", "absolute").animate(ui.originalPosition, "slow", function() {
                    // Return the items position control to it's parent
                    ui.item.css("position", "inherit");
                    ui.item.removeClass('col-lg-6'); 
                    ui.item.addClass('col-md-3');
                    ui.item.children('.close2').html(''); 
                    // Cancel the sortable action to return it to it's origin
                        ui.sender.sortable("cancel");
                    });
              
                 }else if(res=='2A'){
                  Swal.fire({
                  title: 'Please login for perfrom this action.',
                  animation: false,
                  customClass: 'animated bounceIn',
                  confirmButtonClass: 'btn btn-primary',
                  buttonsStyling: false,
                });
                    ui.item.css("position", "absolute").animate(ui.originalPosition, "slow", function() {
                    // Return the items position control to it's parent
                    ui.item.css("position", "inherit");
                    ui.item.removeClass('col-lg-6'); 
                    ui.item.addClass('col-md-3');
                      ui.item.children('.close2').html(''); 
                    // Cancel the sortable action to return it to it's origin
                        ui.sender.sortable("cancel");
                    });
                 }else{
                   ui.item.children('.close2').attr('id',res[0]); 
                    ui.item.attr('id',res[1]); 
                  console.log( "Data Saved: " + res );  
                 }   
                
                });
                 //}
             },
             


        }).disableSelection();

            $( "#right" ).sortable({
            connectWith: ".connectedSortable",
            stop: function(event,ui){
             
                var order = $('#right').children().get().map(function(el,index) {
                  return $(el).attr('id');
                }).join(",");
                //alert(order);
               var baseurl=$('#url').val();
                $.ajax({
                    type: "POST",
                    url: baseurl+"/addbook", 
                    data: {"_token":$('#token').val(),sort:'',order:order,book_data:ui.item.children('input').val(), book_id:ui.item.attr("book"), user_id:$('#user_id').val() }
                }).done(function( res ) {
                 if(res=='3A'){
                  console.log( "Data Saved: " + res );  
              
                 }else if(res=='2A'){
               console.log( "Data Saved: " + res );  
                 }else{
                  
                  console.log( "Data Saved: " + res );  
                 }   
                
                });
            }

          }).disableSelection();

    });
////delete userlist item script////
    $(document).on('click','.close2', function (e) {

    e.preventDefault();
    var id=$(this).attr('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-danger ml-1',
      buttonsStyling: false,
    }).then(function (result) {
      if (result.value) {
        Swal.fire(
          {
            type: "success",
            title: 'Deleted!',
            text: 'Your file has been deleted.',
            confirmButtonClass: 'btn btn-success',
          }
        )
            var baseurl=$('#url').val();
                $.ajax({
                    type: "POST",
                    url: baseurl+"/deletebook", 
                    data: {"_token":$('#token').val(),id:id}
                }).done(function( res ) {
                  if(res==true){
                    location.reload();
                  }

                });


      }
    })
  });

    ////sort booklist item script////
    $(document).on('change','#book_sort', function (e) {
      var sort=$('option:selected',this).val();
      var baseurl=$('#url').val();
                $.ajax({
                    type: "POST",
                    url: baseurl+"/sortbook", 
                    data: {"_token":$('#token').val(),sort:sort}
                }).done(function( res ) {
                  if(res){
                   $('#left').html(res);
                 
                  }

                });

    });
    function showModal(id){
      $('#'+id).show();
    }
      function hideModal(id){
      $('#'+id).hide();
    }

        ////sort booklist item script////
    
    $(document).on('change','#user_sort', function (e) {
      var sort=$('option:selected',this).val();
      var baseurl=$('#url').val();
                $.ajax({
                    type: "POST",
                    url: baseurl+"/sortuserbook", 
                    data: {"_token":$('#token').val(),sort:sort}
                }).done(function( res ) {
                  if(res){
                  $('#search_data').html(res);
                  }

                });

    });

    </script>
   @endsection