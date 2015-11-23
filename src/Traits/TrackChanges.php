<?php

namespace Code4\Platform\Traits;

trait TrackChanges {

    public function getChanges() {

        $message = '';
        if ($this->isDirty()) {
            $dirty = $this->getDirty();
            foreach ($dirty as $field=>$value)
            {
                $message .= 'Zmiana pola <code>'.$field.'</code>z <span class="text-muted">'.$this->getOriginal($field).'</span> na <strong>'.$value.'</strong><br>';
            }
        }
        return $message;

    }

}