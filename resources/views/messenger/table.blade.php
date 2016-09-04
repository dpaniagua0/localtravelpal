<div class="messages-container">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#inbox" aria-controls="inbox" role="tab" data-toggle="tab">Conversations</a></li>
 	</ul>

	<div class="message">
            <!-- Tab panes -->
			<div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="inbox">
			    	@if(sizeof($threads) > 0)
						@foreach($threads as $conversation)
							{{--*/ $unread = ($conversation->isUnread($currentUserId))? 'unread-message' : ''  /*--}}
							<a class="inbox-item {{ $unread }}" href="{{ route('messages.show', $conversation->id)}}">
								<div>
									<div style="width: 20%">
										From
										<br>
										<b>{{ ucwords($conversation->creator()->name ) }}</b>
									</div>
									<div class="pr-15 pl-15">
										@if($conversation->isUnread($currentUserId))
											<label class="label label-default">Unread message</label>
										@endif
									</div>
									<div style="width: 35%;">
										{{ substr($conversation->latestMessage->body, 0, 70) }} ...
									</div>
									<div class="text-right">
										@if(date('Y-m-d',strtotime($conversation->latestMessage->created_at)) == date('Y-m-d'))
											Today {{ date('h:i A', strtotime($conversation->latestMessage->created_at)) }}
										@else
											{{ date('l jS \of F Y h:i:s A', strtotime($conversation->latestMessage->created_at)) }}
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

					{!! $threads->links() !!}

			    </div>

			  
			</div>
	</div> 
</div>                
