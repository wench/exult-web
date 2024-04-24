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

/* mcp_reports.html */
class __TwigTemplate_d4f40155f399d774755cbbab1a87d8fe05a95fa635c3fca8ff526a347c107145 extends \Twig\Template
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
        $location = "mcp_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("mcp_header.html", "mcp_reports.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<form id=\"mcp\" method=\"post\" action=\"";
        // line 3
        echo ($context["S_MCP_ACTION"] ?? null);
        echo "\">

";
        // line 5
        if ( !($context["S_PM"] ?? null)) {
            // line 6
            echo "<fieldset class=\"forum-selection\">
\t<label for=\"fo\">";
            // line 7
            echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo " <select name=\"f\" id=\"fo\">";
            echo ($context["S_FORUM_OPTIONS"] ?? null);
            echo "</select></label>
\t<input type=\"submit\" name=\"sort\" value=\"";
            // line 8
            echo $this->extensions['phpbb\template\twig\extension']->lang("GO");
            echo "\" class=\"button2\" />
\t";
            // line 9
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
</fieldset>
";
        }
        // line 12
        echo "
<h2>";
        // line 13
        echo $this->extensions['phpbb\template\twig\extension']->lang("TITLE");
        echo "</h2>

<div class=\"panel\">
\t<div class=\"inner\">

\t<p>";
        // line 18
        echo $this->extensions['phpbb\template\twig\extension']->lang("EXPLAIN");
        echo "</p>

\t";
        // line 20
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "postrow", [], "any", false, false, false, 20))) {
            // line 21
            echo "\t\t<div class=\"action-bar bar-top\">
\t\t\t<div class=\"pagination\">
\t\t\t\t";
            // line 23
            echo ($context["TOTAL_REPORTS"] ?? null);
            echo "
\t\t\t\t";
            // line 24
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 24))) {
                // line 25
                echo "\t\t\t\t\t";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "mcp_reports.html", 25)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 26
                echo "\t\t\t\t";
            } else {
                // line 27
                echo "\t\t\t\t\t &bull; ";
                echo ($context["PAGE_NUMBER"] ?? null);
                echo "
\t\t\t\t";
            }
            // line 29
            echo "\t\t\t</div>
\t\t</div>

\t\t<ul class=\"topiclist missing-column\">
\t\t\t<li class=\"header\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><div class=\"list-inner\">";
            // line 35
            echo $this->extensions['phpbb\template\twig\extension']->lang("VIEW_DETAILS");
            echo "</div></dt>
\t\t\t\t\t<dd class=\"moderation\"><span>";
            // line 36
            echo $this->extensions['phpbb\template\twig\extension']->lang("REPORTER");
            if ( !($context["S_PM"] ?? null)) {
                echo " &amp; ";
                echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM");
            }
            echo "</span></dd>
\t\t\t\t\t<dd class=\"mark\">";
            // line 37
            echo $this->extensions['phpbb\template\twig\extension']->lang("MARK");
            echo "</dd>
\t\t\t\t</dl>
\t\t\t</li>
\t\t</ul>
\t\t<ul class=\"topiclist cplist missing-column\">

\t\t";
            // line 43
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "postrow", [], "any", false, false, false, 43));
            foreach ($context['_seq'] as $context["_key"] => $context["postrow"]) {
                // line 44
                echo "\t\t\t<li class=\"row";
                if ((twig_get_attribute($this->env, $this->source, $context["postrow"], "S_ROW_COUNT", [], "any", false, false, false, 44) % 2 != 0)) {
                    echo " bg1";
                } else {
                    echo " bg2";
                }
                echo "\">
\t\t\t\t<dl>
\t\t\t\t\t";
                // line 46
                if (($context["S_PM"] ?? null)) {
                    // line 47
                    echo "\t\t\t\t\t<dt>
\t\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t\t<a href=\"";
                    // line 49
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "U_VIEW_DETAILS", [], "any", false, false, false, 49);
                    echo "\" class=\"topictitle\">";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "PM_SUBJECT", [], "any", false, false, false, 49);
                    echo "</a>
\t\t\t\t\t\t\t";
                    // line 50
                    if (twig_get_attribute($this->env, $this->source, $context["postrow"], "ATTACH_ICON_IMG", [], "any", false, false, false, 50)) {
                        echo " <i class=\"icon fa-paperclip fa-fw\" aria-hidden=\"true\"></i>";
                    }
                    // line 51
                    echo "\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<span>";
                    // line 52
                    echo $this->extensions['phpbb\template\twig\extension']->lang("MESSAGE_BY_AUTHOR");
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "PM_AUTHOR_FULL", [], "any", false, false, false, 52);
                    echo " &raquo; ";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "PM_TIME", [], "any", false, false, false, 52);
                    echo "</span><br />
\t\t\t\t\t\t\t<span>";
                    // line 53
                    echo $this->extensions['phpbb\template\twig\extension']->lang("MESSAGE_TO");
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "RECIPIENTS", [], "any", false, false, false, 53);
                    echo "</span>
\t\t\t\t\t\t\t<div class=\"responsive-show\" style=\"display: none;\">
\t\t\t\t\t\t\t\t";
                    // line 55
                    echo $this->extensions['phpbb\template\twig\extension']->lang("REPORTER");
                    echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "REPORTER_FULL", [], "any", false, false, false, 55);
                    echo " &laquo; ";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "REPORT_TIME", [], "any", false, false, false, 55);
                    echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</dt>
\t\t\t\t\t<dd class=\"moderation\">
\t\t\t\t\t\t<span>";
                    // line 60
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "REPORTER_FULL", [], "any", false, false, false, 60);
                    echo " &laquo; ";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "REPORT_TIME", [], "any", false, false, false, 60);
                    echo "</span>
\t\t\t\t\t</dd>
\t\t\t\t\t";
                } else {
                    // line 63
                    echo "\t\t\t\t\t<dt>
\t\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t\t<a href=\"";
                    // line 65
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "U_VIEW_DETAILS", [], "any", false, false, false, 65);
                    echo "\" class=\"topictitle\">";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "POST_SUBJECT", [], "any", false, false, false, 65);
                    echo "</a>
\t\t\t\t\t\t\t";
                    // line 66
                    if (twig_get_attribute($this->env, $this->source, $context["postrow"], "ATTACH_ICON_IMG", [], "any", false, false, false, 66)) {
                        echo " <i class=\"icon fa-paperclip fa-fw\" aria-hidden=\"true\"></i>";
                    }
                    // line 67
                    echo "\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<span>";
                    // line 68
                    echo $this->extensions['phpbb\template\twig\extension']->lang("POSTED");
                    echo " ";
                    echo $this->extensions['phpbb\template\twig\extension']->lang("POST_BY_AUTHOR");
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "POST_AUTHOR_FULL", [], "any", false, false, false, 68);
                    echo " &raquo; ";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "POST_TIME", [], "any", false, false, false, 68);
                    echo "</span>
\t\t\t\t\t\t\t<div class=\"responsive-show\" style=\"display: none;\">
\t\t\t\t\t\t\t\t";
                    // line 70
                    echo $this->extensions['phpbb\template\twig\extension']->lang("REPORTER");
                    echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                    echo " ";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "REPORTER_FULL", [], "any", false, false, false, 70);
                    echo " &laquo; ";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "REPORT_TIME", [], "any", false, false, false, 70);
                    echo "<br />
\t\t\t\t\t\t\t\t";
                    // line 71
                    if (twig_get_attribute($this->env, $this->source, $context["postrow"], "U_VIEWFORUM", [], "any", false, false, false, 71)) {
                        echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM");
                        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                        echo " <a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["postrow"], "U_VIEWFORUM", [], "any", false, false, false, 71);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["postrow"], "FORUM_NAME", [], "any", false, false, false, 71);
                        echo "</a>";
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["postrow"], "FORUM_NAME", [], "any", false, false, false, 71);
                    }
                    // line 72
                    echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</dt>
\t\t\t\t\t<dd class=\"moderation\">
\t\t\t\t\t\t<span>";
                    // line 76
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "REPORTER_FULL", [], "any", false, false, false, 76);
                    echo " &laquo; ";
                    echo twig_get_attribute($this->env, $this->source, $context["postrow"], "REPORT_TIME", [], "any", false, false, false, 76);
                    echo "<br />
\t\t\t\t\t\t";
                    // line 77
                    if (twig_get_attribute($this->env, $this->source, $context["postrow"], "U_VIEWFORUM", [], "any", false, false, false, 77)) {
                        echo $this->extensions['phpbb\template\twig\extension']->lang("FORUM");
                        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
                        echo " <a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["postrow"], "U_VIEWFORUM", [], "any", false, false, false, 77);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["postrow"], "FORUM_NAME", [], "any", false, false, false, 77);
                        echo "</a>";
                    } else {
                        echo twig_get_attribute($this->env, $this->source, $context["postrow"], "FORUM_NAME", [], "any", false, false, false, 77);
                    }
                    echo "</span>
\t\t\t\t\t</dd>
\t\t\t\t\t";
                }
                // line 80
                echo "\t\t\t\t\t<dd class=\"mark\"><input type=\"checkbox\" name=\"report_id_list[]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["postrow"], "REPORT_ID", [], "any", false, false, false, 80);
                echo "\" /></dd>
\t\t\t\t</dl>
\t\t\t</li>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['postrow'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 84
            echo "\t\t</ul>

\t\t<div class=\"action-bar bottom\">
\t\t\t";
            // line 87
            $location = "display_options.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("display_options.html", "mcp_reports.html", 87)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 88
            echo "\t\t\t";
            if (($context["TOPIC_ID"] ?? null)) {
                // line 89
                echo "\t\t\t\t<label>
\t\t\t\t\t<input type=\"hidden\" name=\"t\" value=\"0\">
\t\t\t\t\t<input type=\"checkbox\" class=\"radio\" name=\"t\" value=\"";
                // line 91
                echo ($context["TOPIC_ID"] ?? null);
                echo "\" checked=\"checked\" onClick=\"document.getElementById('mcp').submit()\" />
\t\t\t\t\t<strong>";
                // line 92
                echo $this->extensions['phpbb\template\twig\extension']->lang("ONLY_TOPIC");
                echo "</strong>
\t\t\t\t</label>
\t\t\t";
            }
            // line 95
            echo "
\t\t\t<div class=\"pagination\">
\t\t\t\t";
            // line 97
            echo ($context["TOTAL_REPORTS"] ?? null);
            echo "
\t\t\t\t";
            // line 98
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "pagination", [], "any", false, false, false, 98))) {
                // line 99
                echo "\t\t\t\t\t";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "mcp_reports.html", 99)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 100
                echo "\t\t\t\t";
            } else {
                // line 101
                echo "\t\t\t\t\t &bull; ";
                echo ($context["PAGE_NUMBER"] ?? null);
                echo "
\t\t\t\t";
            }
            // line 103
            echo "\t\t\t</div>
\t\t</div>

\t";
        } else {
            // line 107
            echo "\t\t<p><strong>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO_REPORTS");
            echo "</strong></p>
\t";
        }
        // line 109
        echo "
\t</div>
</div>

";
        // line 113
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "postrow", [], "any", false, false, false, 113))) {
            // line 114
            echo "\t<fieldset class=\"display-actions\">
\t\t<input class=\"button2\" type=\"submit\" value=\"";
            // line 115
            echo $this->extensions['phpbb\template\twig\extension']->lang("DELETE_REPORTS");
            echo "\" name=\"action[delete]\" />
\t\t";
            // line 116
            if ( !($context["S_CLOSED"] ?? null)) {
                echo "&nbsp;<input class=\"button1\" type=\"submit\" name=\"action[close]\" value=\"";
                echo $this->extensions['phpbb\template\twig\extension']->lang("CLOSE_REPORTS");
                echo "\" />";
            }
            // line 117
            echo "\t\t<div><a href=\"#\" onclick=\"marklist('mcp', 'report_id_list', true); return false;\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("MARK_ALL");
            echo "</a> :: <a href=\"#\" onclick=\"marklist('mcp', 'report_id_list', false); return false;\">";
            echo $this->extensions['phpbb\template\twig\extension']->lang("UNMARK_ALL");
            echo "</a></div>
\t</fieldset>
";
        }
        // line 120
        echo "</form>

";
        // line 122
        $location = "mcp_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("mcp_footer.html", "mcp_reports.html", 122)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "mcp_reports.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  427 => 122,  423 => 120,  414 => 117,  408 => 116,  404 => 115,  401 => 114,  399 => 113,  393 => 109,  387 => 107,  381 => 103,  375 => 101,  372 => 100,  359 => 99,  357 => 98,  353 => 97,  349 => 95,  343 => 92,  339 => 91,  335 => 89,  332 => 88,  320 => 87,  315 => 84,  304 => 80,  288 => 77,  282 => 76,  276 => 72,  264 => 71,  255 => 70,  244 => 68,  241 => 67,  237 => 66,  231 => 65,  227 => 63,  219 => 60,  206 => 55,  199 => 53,  191 => 52,  188 => 51,  184 => 50,  178 => 49,  174 => 47,  172 => 46,  162 => 44,  158 => 43,  149 => 37,  141 => 36,  137 => 35,  129 => 29,  123 => 27,  120 => 26,  107 => 25,  105 => 24,  101 => 23,  97 => 21,  95 => 20,  90 => 18,  82 => 13,  79 => 12,  73 => 9,  69 => 8,  62 => 7,  59 => 6,  57 => 5,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "mcp_reports.html", "");
    }
}
