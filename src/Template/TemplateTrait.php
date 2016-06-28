<?php

namespace Flex\Template;

use Exception;
use Psr\Http\Message\StreamInterface;

/**
 * Trait TemplateTrait
 * @package Flex\Template
 *
 * Implements TemplateInterface, except for the start() method.
 */
trait TemplateTrait
{
    protected $__encoding__ = 'UTF-8';
    protected $__stream__;

    /**
     * Can protect certain properties so they won't be overwritten
     * @see add()
     * @return array
     */
    protected function restrictedProperties():array
    {
        return array('__stream__','__encoding__');
    }

    /**
     * Implements methods as partials, does nothing when the method is not found.
     * In this way the partial/method dooes not have to be implemented in the parent
     * or subclasses.
     *
     * @param string $name
     */
    public function partial(string $name)
    {
        if (!method_exists($this, $name)) return;
        $this->$name();
    }

    /**
     * Gives the ability to implement a template from another inheritance tree.
     * The render function is passed false so the output is stored in the output buffer
     *
     * WARNING: if the template is from the same inheritance tree is will cause a circular reference
     *
     * @param TemplateInterface $template
     */
    public function template(TemplateInterface $template)
    {
        $template
        ->addRaw(get_object_vars($this))
        ->start();
    }

    /**
     * @inheritdoc
     *
     *  Accepts the following:
     *
     * - An array that looks like: array(name => value, ...)
     * - An object that implements ViewModelInterface,
     *   this way you can influence which data is send to the template
     * - An object (uses get_object_vars())
     */
    public function add($data):TemplateInterface
    {
        if ($data instanceof ViewModelInterface) {
            $data = $data->getData();
        } elseif (is_object($data)) {
            $data = get_object_vars($data);
        }

        foreach ($data as $name => $value) {
            if (in_array($name, $this->restrictedProperties())) {
                throw new TemplateInvalidArgumentException("Cannot overwrite this property by this name: $name. Use other name.");
            }
            $this->{$name} = $value;
        }

        return $this;
    }

    public function addRaw(array $data):TemplateInterface
    {
        foreach ($data as $name => $value) {
            $this->{$name} = $value;
        }

        return $this;
    }

    /**
     * @inheritdoc
     *
     * This implementation cam also write to a stream directly.
     * So it either returns null (with content written to ob_start to read at a later moment)
     * OR it returns a StreamInterface with its content written
     * OR it returns a string
     *
     * @TODO: Set chunk_size for ob_start(). What is optimal?
     * @TODO: Possibility to set another closure for ob_start to do something like compression
     */
    public function render($toString = true)
    {
        try {
            $hasStream = isset($this->__stream__);
            if ($hasStream) {
                ob_start(function ($data) {
                    $this->__stream__->write($data);
                    return '';
                });
            } else {
                ob_start();
            }
            $this->start();

            if ($hasStream) {
                ob_end_clean();
                return $this->__stream__;
            }

            if ($toString) {
                return ob_get_clean();
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Sets a StreamInterface which the templated is streamed to
     *
     * @param StreamInterface $stream
     * @return $this
     */
    public function setStream(StreamInterface $stream)
    {
        $this->__stream__ = $stream;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Gets a value from the template, defaults to NullObject or a user defined default
     *
     * This is a useful method when you chain behind a template value but don't know if it exists
     *
     * @param int|string $key
     * @param null $default
     * @return \Flex\Template\NullObject|null|mixed
     */
    public function get($key, $default = null)
    {
        if (!isset($this->$key)) {
            return $default !== null ? $default : new NullObject();
        }
        return $this->$key;
    }

    /**
     * Checks if the template has a certain key > value
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->$key);
    }

    /**
     * Sets encoding for escaping (@see escape())
     *
     * @param $encoding
     * @return $this
     */
    public function setEncoding($encoding)
    {
        $this->__encoding__ = $encoding;
        return $this;
    }

    /**
     * Gets encoding
     * @return string
     */
    public function getEncoding()
    {
        return $this->__encoding__;
    }

    /**
     * Escapes data in HTML5 context
     *
     * @param $data
     * @return string
     */
    public function escape($data)
    {
        return htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, $this->__encoding__);
    }

}