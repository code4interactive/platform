<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Historia zmian</h5>
        @if ($participates)
            <span class="label label-info">{!! $newMessages !!} Nowych</span>
        @endif

        <div class="ibox-tools">
            @if (!$participates)
                <button class="btn btn-primary btn-xs" data-action="watchThread" data-thread="{!! $thread->id !!}"><i class="fa fa-eye"></i> Obserwuj</button>
            @else
                Obserwujesz ten wątek -
                <button class="btn btn-danger btn-xs" data-action="watchThread" data-thread="{!! $thread->id !!}"><i class="fa fa-eye-slash"></i> Nie obserwuj</button>
            @endif
        </div>
    </div>
    <div class="ibox-content">

        <div class="feed-activity-list">

            @foreach($thread->messagesNewestFirst() as $message)

                <div class="feed-element">
                    <a href="profile.html" class="pull-left">
                        {!! $message->user->getAvatar() !!}
                    </a>

                    <div class="media-body ">
                        <div class="pull-right">
                            <small>{!! \Carbon\Carbon::instance($message->created_at)->diffForHumans() !!}</small>
                            @if(\Carbon\Carbon::instance($message->created_at)->between($last_read, new Carbon\Carbon()))
                                <span class="label label-info">Nowy</span>
                            @endif
                        </div>
                        <strong>{!! $message->user->getFirstAndLastName() !!}</strong><br>
                        <small class="text-muted">{!! \Carbon\Carbon::instance($message->created_at)->toDateTimeString() !!}</small>
                            <p></p>
                            <p>{!! $message->body !!}</p>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="feed-element">
            <a href="profile.html" class="pull-left">
                {!! $currentUser->getAvatar() !!}
            </a>

            <div class="media-body ">
                <form action="/writeComment" method="post" class="ajax">
                    <div class="form-group">
                        <textarea name="message" class="form-control" placeholder="Napisz komentarz..."></textarea>
                    </div>
                    <input type="hidden" name="threadId" value="{!! $thread->id !!}"/>
                    <div class="pull-right">
                        <div class="checkbox checkbox-info checkbox-inline">
                            <input id="checkbox" name="watch" type="checkbox">
                            <label for="checkbox">Obserwuj wątek</label>
                        </div> &nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-thumbs-up"></i> Zapisz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


