<?php
namespace Code4\Platform\Menu;

use Illuminate\Support\Contracts\JsonableInterface;
use Illuminate\Support\Contracts\ArrayableInterface;

class MenuItem implements JsonableInterface, ArrayableInterface
{

    /**
     * Notification message.
     *
     * @var string|null
     */
    protected $message = null;

    /**
     * Notification message format.
     * Replacements:
     * :message - notification message.
     * :type - type of message (error, success, warning, info).
     *
     * @var string|null
     */
    protected $format = null;

    /**
     * Notification type (error, success, warning, info).
     *
     * @var string|null
     */
    protected $type = null;

    /**
     * Is notification flashable?
     * If flashable, then it will be displayed on next request.
     * If no, it will be displayed in same request.
     *
     * @var bool
     */
    protected $flashable = true;

    /**
     * Message allias.
     *
     * @var string|null
     */
    protected $alias = null;

    /**
     * Message position.
     *
     * @var int|null
     */
    protected $position = null;

    /**
     * Construct default message object.
     *
     * @param null $type
     * @param null $message
     * @param bool $flashable
     * @param null $format
     * @param null $alias
     * @param null $position
     */
    public function __construct($type = null, $message = null, $flashable = true, $format = null, $alias = null, $position = null)
    {
        $this->setType($type);
        $this->setMessage($message);
        $this->setFlashable($flashable);
        $this->setFormat($format);
        $this->setAlias($alias);
        $this->setPosition($position);
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Evaluates object as string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}