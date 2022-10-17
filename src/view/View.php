<?php

namespace App\view;

class View
{

    protected $parts;
    protected $template;

    public function __construct($template, $parts = array())
    {
        $this->setTemplate($template);
        $this->setParts($parts);
    }

    public function setParts(array $parts)
    {
        $this->parts = $parts;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function setPart($key, $content)
    {
        $this->parts[$key] = $content;
    }

    public function getPart($key)
    {
        if (isset($this->parts[$key])) {
            return $this->parts[$key];
        } else {
            return null;
        }
    }

    public function setMenu()
    {
        $menu[] = array(
            "link" => "/",
            "text" => "Accueil",
            "class" => "menu-item",
        );
        $menu[] = array(
            "link" => "/?controller=zoo",
            "text" => "Zoo",
            "class" => "menu-item",
        );

        $menu = $this->menuToHtml($menu);
        $this->setPart('menu', $menu);
    }

    public function render()
    {
        $this->setMenu();
        $title = $this->getPart('title');
        $content = $this->getPart('content');
        $menu = $this->getPart('menu');

        ob_start();
        include($this->template);
        $data = ob_get_contents();
        ob_end_clean();

        return $data;
    }

    public function menuToHtml($menu)
    {
        $str = "";
        foreach ($menu as $key => $item) {
            $str .= '<li class="' . $item["class"] . '">';
            $str .= '<a href="' . $item["link"] . '">';
            $str .= '<span>' . $item["text"] . '</span>';
            $str .= '</a></li>';
        }
        return $str;
    }
}
?>