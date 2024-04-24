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

/* mcp_warn_front.html */
class __TwigTemplate_321a8b7b6f75dfc781a8fb3138afdb2ef803bf571e3fd8b50b03e72e8349b5d5 extends \Twig\Template
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
        $this->loadTemplate("mcp_header.html", "mcp_warn_front.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<form method=\"post\" id=\"mcp\" action=\"";
        // line 3
        echo ($context["U_POST_ACTION"] ?? null);
        echo "\">

<h2>";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("WARN_USER");
        echo "</h2>

<div class=\"panel\">
\t<div class=\"inner\">

\t<h3>";
        // line 10
        echo $this->extensions['phpbb\template\twig\extension']->lang("SELECT_USER");
        echo "</h3>

\t<fieldset>
\t<dl>
\t\t<dt><label for=\"username\">";
        // line 14
        echo $this->extensions['phpbb\template\twig\extension']->lang("SELECT_USER");
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label></dt>
\t\t<dd><input name=\"username\" id=\"username\" type=\"text\" class=\"inputbox\" /></dd>
\t\t<dd><strong><a href=\"";
        // line 16
        echo ($context["U_FIND_USERNAME"] ?? null);
        echo "\" onclick=\"find_username(this.href); return false;\">";
        echo $this->extensions['phpbb\template\twig\extension']->lang("FIND_USERNAME");
        echo "</a></strong></dd>
\t</dl>
\t</fieldset>

\t</div>
</div>

<fieldset class=\"submit-buttons\">
\t<input type=\"submit\" name=\"submituser\" value=\"";
        // line 24
        echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
        echo "\" class=\"button1\" />
\t";
        // line 25
        echo ($context["S_FORM_TOKEN"] ?? null);
        echo "
</fieldset>
</form>

<div class=\"panel\">
\t<div class=\"inner\">

\t<h3>";
        // line 32
        echo $this->extensions['phpbb\template\twig\extension']->lang("MOST_WARNINGS");
        echo "</h3>

\t";
        // line 34
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "highest", [], "any", false, false, false, 34))) {
            // line 35
            echo "\t\t<table class=\"table1\">
\t\t<thead>
\t\t\t<tr>
\t\t\t\t<th class=\"name\">";
            // line 38
            echo $this->extensions['phpbb\template\twig\extension']->lang("USERNAME");
            echo "</th>
\t\t\t\t<th class=\"name\">";
            // line 39
            echo $this->extensions['phpbb\template\twig\extension']->lang("WARNINGS");
            echo "</th>
\t\t\t\t<th class=\"name\">";
            // line 40
            echo $this->extensions['phpbb\template\twig\extension']->lang("LATEST_WARNING_TIME");
            echo "</th>
\t\t\t\t<th></th>
\t\t\t</tr>
\t\t</thead>
\t\t<tbody>

\t\t";
            // line 46
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "highest", [], "any", false, false, false, 46));
            foreach ($context['_seq'] as $context["_key"] => $context["highest"]) {
                // line 47
                echo "\t\t\t<tr class=\"";
                if ((twig_get_attribute($this->env, $this->source, $context["highest"], "S_ROW_COUNT", [], "any", false, false, false, 47) % 2 == 0)) {
                    echo "bg1";
                } else {
                    echo "bg2";
                }
                echo "\">
\t\t\t\t<td>";
                // line 48
                echo twig_get_attribute($this->env, $this->source, $context["highest"], "USERNAME_FULL", [], "any", false, false, false, 48);
                echo "</td>
\t\t\t\t<td>";
                // line 49
                echo twig_get_attribute($this->env, $this->source, $context["highest"], "WARNINGS", [], "any", false, false, false, 49);
                echo "</td>
\t\t\t\t<td>";
                // line 50
                echo twig_get_attribute($this->env, $this->source, $context["highest"], "WARNING_TIME", [], "any", false, false, false, 50);
                echo "</td>
\t\t\t\t<td><a href=\"";
                // line 51
                echo twig_get_attribute($this->env, $this->source, $context["highest"], "U_NOTES", [], "any", false, false, false, 51);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("VIEW_NOTES");
                echo "</a></td>
\t\t\t</tr>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['highest'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 54
            echo "\t\t</tbody>
\t\t</table>
\t";
        } else {
            // line 57
            echo "\t\t<p><strong>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO_WARNINGS");
            echo "</strong></p>
\t";
        }
        // line 59
        echo "
\t</div>
</div>

<div class=\"panel\">
\t<div class=\"inner\">

\t<h3>";
        // line 66
        echo $this->extensions['phpbb\template\twig\extension']->lang("LATEST_WARNINGS");
        echo "</h3>

\t";
        // line 68
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "latest", [], "any", false, false, false, 68))) {
            // line 69
            echo "\t\t<table class=\"table1\">
\t\t<thead>
\t\t\t<tr>
\t\t\t\t<th class=\"name\">";
            // line 72
            echo $this->extensions['phpbb\template\twig\extension']->lang("USERNAME");
            echo "</th>
\t\t\t\t<th class=\"name\">";
            // line 73
            echo $this->extensions['phpbb\template\twig\extension']->lang("TIME");
            echo "</th>
\t\t\t\t<th class=\"name\">";
            // line 74
            echo $this->extensions['phpbb\template\twig\extension']->lang("TOTAL_WARNINGS");
            echo "</th>
\t\t\t\t<th></th>
\t\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
            // line 79
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "latest", [], "any", false, false, false, 79));
            foreach ($context['_seq'] as $context["_key"] => $context["latest"]) {
                // line 80
                echo "\t\t\t<tr class=\"";
                if ((twig_get_attribute($this->env, $this->source, $context["latest"], "S_ROW_COUNT", [], "any", false, false, false, 80) % 2 == 0)) {
                    echo "bg1";
                } else {
                    echo "bg2";
                }
                echo "\">
\t\t\t\t<td>";
                // line 81
                echo twig_get_attribute($this->env, $this->source, $context["latest"], "USERNAME_FULL", [], "any", false, false, false, 81);
                echo "</td>
\t\t\t\t<td>";
                // line 82
                echo twig_get_attribute($this->env, $this->source, $context["latest"], "WARNING_TIME", [], "any", false, false, false, 82);
                echo "</td>
\t\t\t\t<td>";
                // line 83
                echo twig_get_attribute($this->env, $this->source, $context["latest"], "WARNINGS", [], "any", false, false, false, 83);
                echo "</td>
\t\t\t\t<td><a href=\"";
                // line 84
                echo twig_get_attribute($this->env, $this->source, $context["latest"], "U_NOTES", [], "any", false, false, false, 84);
                echo "\">";
                echo $this->extensions['phpbb\template\twig\extension']->lang("VIEW_NOTES");
                echo "</a></td>
\t\t\t</tr>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['latest'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 87
            echo "\t\t</tbody>
\t\t</table>
\t";
        } else {
            // line 90
            echo "\t\t<p><strong>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO_WARNINGS");
            echo "</strong></p>
\t";
        }
        // line 92
        echo "
\t</div>
</div>

";
        // line 96
        $location = "mcp_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("mcp_footer.html", "mcp_warn_front.html", 96)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "mcp_warn_front.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  271 => 96,  265 => 92,  259 => 90,  254 => 87,  243 => 84,  239 => 83,  235 => 82,  231 => 81,  222 => 80,  218 => 79,  210 => 74,  206 => 73,  202 => 72,  197 => 69,  195 => 68,  190 => 66,  181 => 59,  175 => 57,  170 => 54,  159 => 51,  155 => 50,  151 => 49,  147 => 48,  138 => 47,  134 => 46,  125 => 40,  121 => 39,  117 => 38,  112 => 35,  110 => 34,  105 => 32,  95 => 25,  91 => 24,  78 => 16,  72 => 14,  65 => 10,  57 => 5,  52 => 3,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "mcp_warn_front.html", "");
    }
}
