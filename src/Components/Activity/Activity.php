<?php

namespace Code4\Platform\Components\Activity;

use Carbon\Carbon;
use Code4\Platform\Models\Thread;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Code4\Platform\Models\User;

class Activity {

    /**
     * Adds comment to thread
     * @param Thread $thread
     * @param string $message
     * @param int $userId
     * @param bool|false $watch
     */
    public function comment(Thread $thread, $message, $userId, $watch = false) {
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => $userId,
                'body'      => $message,
            ]
        );

        if ($watch)
        {
            Participant::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => $userId,
                    'last_read' => new Carbon()
                ]
            );
        }
    }

    public function log($subject, $message, $userId = 1, $watch = false) {
        //Sprawdzamy czy thread istnieje
        $thread = Thread::firstOrNew(
            [
                'subject' => $subject,
            ]
        );
        $thread->save();
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => $userId,
                'body'      => $message,
            ]
        );

        // Sender - if watch set to true, add message creator to participants
        if ($watch)
        {
            Participant::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => $userId,
                    'last_read' => new Carbon()
                ]
            );
        }
    }

    public function watchThread(Thread $thread, $userId) {
        if ($thread->hasParticipant($userId)) {
            $thread->removeParticipant($userId);
        } else {
            $thread->addParticipants([$userId]);
        }
    }

    public function getThread($subject) {
        return Thread::findBySubject($subject)->get();
    }

    /**
     * @param string $subject
     * @return mixed|int
     * @throws \Exception
     */
    public function findActivityIdBySubject($subject) {
        return Thread::findBySubject($subject)->firstOrFail();
    }

    /**
     * Prepares feed for displaying activity box
     * @param $thread
     * @return array
     */
    public function prepareFeed($thread, $userId) {
        //If thread do not exists - create one to allow commenting
        $thread = Thread::firstOrNew(['subject' => $thread]);
        $thread->save();

        //$userId = \Auth::currentUserId();
        $currentUser = User::find($userId);
        $participates = $thread->hasParticipant($userId);
        $newMessages = $thread->countNewMessagesForUser($userId);

        //Find last_read date or set it to now if user is participant.
        $last_read = new Carbon();
        if ($participates) {
            $last_read = $thread->getParticipantFromUser($userId)->last_read;
            $last_read = new Carbon($last_read);
        }
        $last_read->addSecond();

        //Mark thread as read
        $thread->markAsRead($userId);


        return [$thread, $participates, $newMessages, $last_read, $currentUser];
    }

    /**
     * Gets all new messages in threads for current user
     */
    public function prepareDailyFeed($userId) {
        $user = User::find($userId);
        $threads = $user->threadsWithNewMessages();

    }
}