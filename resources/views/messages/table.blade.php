<div class="messages-container">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#inbox" aria-controls="inbox" role="tab" data-toggle="tab">Inbox</a></li>
		<li role="presentation"><a href="#sent-mail" aria-controls="sent-mail" role="tab" data-toggle="tab">Sent Mail</a></li>
 	</ul>

	<div class="message">
            <!-- Tab panes -->
			<div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="inbox">
			    	@if(sizeof($inbox) > 0)
						@foreach($inbox as $message)
							{{--*/ $unread = ($message->status == 0)? 'unread-message' : ''  /*--}}
							<a class="inbox-item {{ $unread }}" href="{{ route('messages.show', $message->id)}}">
								<div>
									<div style="width: 20%">
										From
										<br>
										<b>{{ ucwords($message->sender->name) }}</b>
									</div>
									<div class="pr-15 pl-15">
										@if($message->status == 0)
											<label class="label label-default">Unread message</label>
										@endif
									</div>
									<div style="width: 35%;">
										{{ substr($message->message, 0, 70) }} ...
									</div>
									<div class="text-right">
										@if(date('Y-m-d',strtotime($message->created_at)) == date('Y-m-d'))
											Today {{ date('h:i A', strtotime($message->created_at)) }}
										@else
											{{ date('l jS \of F Y h:i:s A', strtotime($message->created_at)) }}
										@endif
									</div>
								</div>
							</a>
    					@endforeach
    				@else
					    <h1 class="alert alert-info text-center">
					        No messages found
					    </h1>
					@endif  

					{!! $inbox->links() !!}

			    </div>

			    <div role="tabpanel" class="tab-pane" id="sent-mail">
			    	@if(sizeof($sent) > 0)
						@foreach($sent as $message)
							<a class="inbox-item" href="{{ route('messages.show', $message->id)}}">
								<div>
									<div style="width: 20%">
										From
										<br>
										<b>{{ ucwords($message->sender->name) }}</b>
									</div>
									<div class="pr-15 pl-15">
										@if($message->status == 0)
											<label class="label label-default">Unread message</label>
										@endif
									</div>
									<div style="width: 35%;">
										{{ substr($message->message, 0, 70) }} ...
									</div>
									<div class="text-right">
										@if(date('Y-m-d',strtotime($message->created_at)) == date('Y-m-d'))
											Today {{ date('h:i A', strtotime($message->created_at)) }}
										@else
											{{ date('l jS \of F Y h:i:s A', strtotime($message->created_at)) }}
										@endif
									</div>
								</div>
							</a>
    					@endforeach
    				@else
					    <h1 class="alert alert-info text-center">
					        No sent messages found
					    </h1>
					@endif 

					{!! $sent->links() !!} 
			    </div>
			</div>
	</div> 
</div>                
