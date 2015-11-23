<?php

namespace Code4\Platform\Controllers;

use App\Http\Controllers\Controller;
use Code4\Platform\Components\Activity\AddCommentForm;
use Code4\Platform\Contracts\Auth;
use Code4\Platform\Exceptions\ThreadNotFoundException;
use Code4\Platform\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;

class ActivityController extends Controller {

    public function getActivityFeed(Request $request, Auth $auth) {
        if ($request->has('feedSubject')) {
            $feedSubject = $request->get('feedSubject');
        } else if ($request->has('feedId')) {
            $feedId = $request->get('feedId');
            $thread = Thread::find($feedId);
            if (!$thread) {
                throw new ModelNotFoundException();
            }
            $feedSubject = $thread->subject;
        }

        list($thread, $participates, $newMessages, $last_read, $currentUser) = \Activity::prepareFeed($feedSubject, $auth->currentUserId());
        return view('platform::partials.feed', compact('thread', 'participates', 'newMessages', 'last_read', 'currentUser'));
    }


    public function comment(Request $request, Auth $auth) {
        $form = new AddCommentForm();
        if (!$form->validate($request)) {
            return $form->response();
        }

        $threadId = $request->get('threadId');
        $thread = Thread::find($threadId);
        if (!$thread) {
            throw new ModelNotFoundException();
        }

        \Activity::comment($thread, $request->get('message'), $auth->currentUserId(), $request->has('watch'));

        return \PlatformResponse::reloadFeed($thread->subject)->makeResponse();
    }

    /**
     * @param $threadId
     * @param Auth $auth
     * @return mixed
     */
    public function watchThread($threadId, Auth $auth){
        $thread = Thread::find((int)$threadId);
        //var_dump($thread);
        if (!$thread) {
            throw new ModelNotFoundException();
        }
        //$userId = $auth->currentUserId();
        \Activity::watchThread($thread, $auth->currentUserId());

        return \PlatformResponse::reloadFeed($thread->subject)->makeResponse();
    }
}