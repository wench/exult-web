<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* navbar_footer.html */
class __TwigTemplate_86fe2618c3daa4e2e0d3246f50e2069b171bfd6cdc201de9c3ccf917cf2292ef extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"navbar\" role=\"navigation\">
\t<div class=\"inner\">

\t<ul id=\"nav-footer\" class=\"nav-footer linklist\" role=\"menubar\">
\t\t";
        // line 5
        if ((($context["U_WATCH_FORUM_LINK"] ?? null) &&  !($context["S_IS_BOT"] ?? null))) {
            // line 6
            echo "\t\t\t<li data-last-responsive=\"true\">
\t\t\t\t<a href=\"";
            // line 7
            echo ($context["U_WATCH_FORUM_LINK"] ?? null);
            echo "\" title=\"";
            echo ($context["S_WATCH_FORUM_TITLE"] ?? null);
            echo "\" data-ajax=\"toggle_link\" data-toggle-class=\"icon ";
            if (($context["S_WATCHING_FORUM"] ?? null)) {
                echo "fa-check-square-o";
            } else {
                echo "fa-square-o";
            }
            echo " fa-fw\" data-toggle-text=\"";
            echo ($context["S_WATCH_FORUM_TOGGLE"] ?? null);
            echo "\" data-toggle-url=\"";
            echo ($context["U_WATCH_FORUM_TOGGLE"] ?? null);
            echo "\">
\t\t\t\t\t<i class=\"icon ";
            // line 8
            if (($context["S_WATCHING_FORUM"] ?? null)) {
                echo "fa-square-o";
            } else {
                echo "fa-check-square-o";
            }
            echo " fa-fw\" aria-hidden=\"true\"></i><span>";
            echo ($context["S_WATCH_FORUM_TITLE"] ?? null);
            echo "</span>
\t\t\t\t</a>
\t\t\t</li>
\t\t";
        }
        // line 12
        echo "
\t\t";
        // line 13
        // line 14
        echo "\t\t<li class=\"rightside\">";
        echo ($context["S_TIMEZONE"] ?? null);
        echo "</li>
\t\t";
        // line 15
        // line 16
        echo "\t\t";
        if ( !($context["S_IS_BOT"] ?? null)) {
            // line 17
            echo "\t\t\t<li class=\"rightside\">
\t\t\t\t<a href=\"";
            // line 18
            echo ($context["U_DELETE_COOKIES"] ?? null);
            echo "\" data-ajax=\"true\" data-refresh=\"true\" role=\"menuitem\">
\t\t\t\t\t<i class=\"icon fa-trash fa-fw\" aria-hidden=\"true\"></i><span>";
            // line 19
            echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_COOKIES");
            echo "</span>
\t\t\t\t</a>
\t\t\t</li>
\t\t\t";
            // line 22
            if (($context["S_DISPLAY_MEMBERLIST"] ?? null)) {
                // line 23
                echo "\t\t\t\t<li class=\"rightside\" data-last-responsive=\"true\">
\t\t\t\t\t<a href=\"";
                // line 24
                echo ($context["U_MEMBERLIST"] ?? null);
                echo "\" title=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("MEMBERLIST_EXPLAIN");
                echo "\" role=\"menuitem\">
\t\t\t\t\t\t<i class=\"icon fa-group fa-fw\" aria-hidden=\"true\"></i><span>";
                // line 25
                echo $this->extensions['phpbb\template\twig\extension']->lang("MEMBERLIST");
                echo "</span>
\t\t\t\t\t</a>
\t\t\t\t</li>
\t\t\t";
            }
            // line 29
            echo "\t\t";
        }
        // line 30
        echo "\t\t";
        // line 31
        echo "\t\t";
        if (($context["U_TEAM"] ?? null)) {
            // line 32
            echo "\t\t\t<li class=\"rightside\" data-last-responsive=\"true\">
\t\t\t\t<a href=\"";
            // line 33
            echo ($context["U_TEAM"] ?? null);
            echo "\" role=\"menuitem\">
\t\t\t\t\t<i class=\"icon fa-shield fa-fw\" aria-hidden=\"true\"></i><span>";
            // line 34
            echo $this->extensions['phpbb\template\twig\extension']->lang("THE_TEAM");
            echo "</span>
\t\t\t\t</a>
\t\t\t</li>
\t\t";
        }
        // line 38
        echo "\t\t";
        // line 39
        echo "\t\t";
        if (($context["U_CONTACT_US"] ?? null)) {
            // line 40
            echo "\t\t\t<li class=\"rightside\" data-last-responsive=\"true\">
\t\t\t\t<a href=\"";
            // line 41
            echo ($context["U_CONTACT_US"] ?? null);
            echo "\" role=\"menuitem\">
\t\t\t\t\t<i class=\"icon fa-envelope fa-fw\" aria-hidden=\"true\"></i><span>";
            // line 42
            echo $this->extensions['phpbb\template\twig\extension']->lang("CONTACT_US");
            echo "</span>
\t\t\t\t</a>
\t\t\t</li>
\t\t";
        }
        // line 46
        echo "\t</ul>

\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "navbar_footer.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 46,  155 => 42,  151 => 41,  148 => 40,  145 => 39,  143 => 38,  136 => 34,  132 => 33,  129 => 32,  126 => 31,  124 => 30,  121 => 29,  114 => 25,  108 => 24,  105 => 23,  103 => 22,  97 => 19,  93 => 18,  90 => 17,  87 => 16,  86 => 15,  81 => 14,  80 => 13,  77 => 12,  64 => 8,  48 => 7,  45 => 6,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "navbar_footer.html", "");
    }
}
