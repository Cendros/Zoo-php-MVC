<?php

namespace App\router;

class Request
{

    private $get;
    private $post;

    public function __construct($get, $post)
    {
        $this->setGet($get);
        $this->setPost($post);
    }

    public function setGet($get)
    {
        $this->get = $get;
    }

    public function setPost($post)
    {
        $this->post = $post;
    }

    public function getGetParam($key, $default = null)
    {
        if (!isset($this->get[$key]))
            return $default;
        return $this->get[$key];
    }

    public function getPostParam($key, $default = null)
    {
        if (!isset($this->post[$key]))
            return $default;
        return $this->post[$key];
    }
}
?>