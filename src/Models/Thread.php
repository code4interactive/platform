<?php

namespace Code4\Platform\Models;

use \Cmgmyr\Messenger\Models\Thread as BaseThread;

class Thread extends BaseThread {

    /**
     * Finds threads by subject
     * @param $query
     * @param $subject
     * @return mixed
     */
    public function scopeFindBySubject($query, $subject) {
        return $query->where('subject', $subject);
    }


    /**
     * Gets messages in newest to oldest order
     * @return mixed
     */
    public function messagesNewestFirst() {
        return $this->messages()->orderBy('created_at', 'desc')->get();
    }

    public function countNewMessagesForUser($userId) {
        $newMessages = 0;
        try {
            if ($participant = $this->getParticipantFromUser($userId)) {
                $last_read = $participant->last_read;
                $newMessages = $this->messages()->where('created_at', '>', $last_read)->get()->count();
            }
        } catch(\Exception $e) {

        }
        return $newMessages;
    }

    /**
     * Removes participant from thread
     * @param $userId
     * @return mixed
     */
    public function removeParticipant($userId) {
        return $this->participants()->where('user_id', $userId)->delete();
    }

}