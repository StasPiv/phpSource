<?php
/**
 * Created by phpSource.
 * User: ssp
 * Date: 02.02.17
 * Time: 17:57
 */

namespace StasPiv\PhpSource;


class PhpParam extends PhpElement
{
    /**
     * @var
     */
    private $type;
    /**
     * @var null
     */
    private $defaultValue;


    /**
     * PhpParam constructor.
     * @param $identifier
     * @param $type
     * @param null $defaultValue
     */
    public function __construct($identifier, $type = null, $defaultValue = null)
    {
        $this->identifier = $identifier;
        $this->type = $type;
        $this->defaultValue = $defaultValue;
    }

    public function getSource()
    {
        $source = '$'.$this->identifier;

        if ($this->type) {
            $source = $this->type.' '.$source;
        }

        if ($this->defaultValue) {
            $source.=' = '.$this->defaultValue;
        }

        return $source;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return null
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

}