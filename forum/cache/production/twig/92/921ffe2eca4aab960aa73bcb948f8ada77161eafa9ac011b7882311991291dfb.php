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

/* captcha_qa_acp.html */
class __TwigTemplate_8dca1820e78ff002112d4869b2605bd45ca4e35419e6a64b978576da331f14d2 extends \Twig\Template
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
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_header.html", "captcha_qa_acp.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

\t<a href=\"";
        // line 5
        if (($context["U_LIST"] ?? null)) {
            echo ($context["U_LIST"] ?? null);
        } else {
            echo ($context["U_ACTION"] ?? null);
        }
        echo "\" style=\"float: ";
        echo ($context["S_CONTENT_FLOW_END"] ?? null);
        echo ";\">&laquo; ";
        echo $this->extensions['phpbb\template\twig\extension']->lang("BACK");
        echo "</a>

\t<h1>";
        // line 7
        echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTIONS");
        echo "</h1>

\t<p>";
        // line 9
        echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTIONS_EXPLAIN");
        echo "</p>
";
        // line 10
        if (($context["S_LIST"] ?? null)) {
            // line 11
            echo "\t<form id=\"captcha_qa\" method=\"post\" action=\"";
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset class=\"tabulated\">
\t<legend>";
            // line 14
            echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTIONS");
            echo "</legend>

\t<table class=\"table1 zebra-table\">
\t<thead>
\t<tr>
\t\t<th colspan=\"3\">";
            // line 19
            echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTIONS");
            echo "</th>
\t</tr>
\t<tr class=\"row3\">
\t\t<td style=\"text-align: center;\">";
            // line 22
            echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTION_TEXT");
            echo "</td>
\t\t<td style=\"width: 5%; text-align: center;\">";
            // line 23
            echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTION_LANG");
            echo "</td>
\t\t<td style=\"vertical-align: top; width: 50px; text-align: center; white-space: nowrap;\">";
            // line 24
            echo $this->extensions['phpbb\template\twig\extension']->lang("ACTION");
            echo "</td>
\t</tr>
\t</thead>

\t<tbody>
\t";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["questions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["question"]) {
                // line 30
                echo "\t\t<tr>
\t\t\t";
                // line 32
                echo "\t\t\t<td>";
                echo twig_get_attribute($this->env, $this->source, $context["question"], "QUESTION_TEXT", [], "any", false, false, false, 32);
                echo "</td>
\t\t\t<td style=\"text-align: center;\">";
                // line 33
                echo twig_get_attribute($this->env, $this->source, $context["question"], "QUESTION_LANG", [], "any", false, false, false, 33);
                echo "</td>
\t\t\t<td style=\"text-align: center;\"><a href=\"";
                // line 34
                echo twig_get_attribute($this->env, $this->source, $context["question"], "U_EDIT", [], "any", false, false, false, 34);
                echo "\">";
                echo ($context["ICON_EDIT"] ?? null);
                echo "</a> <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["question"], "U_DELETE", [], "any", false, false, false, 34);
                echo "\">";
                echo ($context["ICON_DELETE"] ?? null);
                echo "</a></td>
\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['question'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "\t</tbody>

\t</table>
\t<fieldset class=\"quick\">
\t\t<input class=\"button1\" type=\"submit\" name=\"add\" value=\"";
            // line 41
            echo $this->extensions['phpbb\template\twig\extension']->lang("ADD");
            echo "\" />
\t\t<input  type=\"hidden\" name=\"action\" value=\"add\" />
\t\t<input  type=\"hidden\" name=\"configure\" value=\"1\" />
\t\t<input  type=\"hidden\" name=\"select_captcha\" value=\"";
            // line 44
            echo ($context["CLASS"] ?? null);
            echo "\" />

\t\t";
            // line 46
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t";
            // line 48
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>
";
        } else {
            // line 52
            echo "\t";
            if (($context["S_ERROR"] ?? null)) {
                // line 53
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 54
                echo $this->extensions['phpbb\template\twig\extension']->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 55
                echo $this->extensions['phpbb\template\twig\extension']->lang("QA_ERROR_MSG");
                echo "</p>
\t\t</div>
\t";
            }
            // line 58
            echo "\t<form id=\"captcha_qa\" method=\"post\" action=\"";
            echo ($context["U_ACTION"] ?? null);
            echo "\">
\t<fieldset>
\t\t<legend>";
            // line 60
            echo $this->extensions['phpbb\template\twig\extension']->lang("EDIT_QUESTION");
            echo "</legend>
\t<dl>
\t\t<dt><label for=\"strict\">";
            // line 62
            echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTION_STRICT");
            echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTION_STRICT_EXPLAIN");
            echo "</span></dt>
\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"strict\" value=\"1\"";
            // line 63
            if (($context["STRICT"] ?? null)) {
                echo " id=\"strict\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("YES");
            echo "</label>
\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"strict\" value=\"0\"";
            // line 64
            if ( !($context["STRICT"] ?? null)) {
                echo " id=\"strict\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("NO");
            echo "</label></dd>
\t</dl>

\t<dl>
\t\t<dt><label for=\"lang_iso\">";
            // line 68
            echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTION_LANG");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTION_LANG_EXPLAIN");
            echo "</span></dt>
\t\t<dd><select id=\"lang_iso\" name=\"lang_iso\">";
            // line 69
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["loops"] ?? null), "langs", [], "any", false, false, false, 69));
            foreach ($context['_seq'] as $context["_key"] => $context["langs"]) {
                echo "<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["langs"], "ISO", [], "any", false, false, false, 69);
                echo "\" ";
                if ((twig_get_attribute($this->env, $this->source, $context["langs"], "ISO", [], "any", false, false, false, 69) == ($context["LANG_ISO"] ?? null))) {
                    echo " selected=\"selected\" ";
                }
                echo ">";
                echo twig_get_attribute($this->env, $this->source, $context["langs"], "NAME", [], "any", false, false, false, 69);
                echo "</option>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['langs'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</select></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"question_text\">";
            // line 72
            echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTION_TEXT");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTION_TEXT_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input id=\"question_text\" maxlength=\"255\" size=\"60\" name=\"question_text\" type=\"text\" value=\"";
            // line 73
            echo ($context["QUESTION_TEXT"] ?? null);
            echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"answers\">";
            // line 76
            echo $this->extensions['phpbb\template\twig\extension']->lang("QUESTION_ANSWERS");
            echo "</label><br /><span>";
            echo $this->extensions['phpbb\template\twig\extension']->lang("ANSWERS_EXPLAIN");
            echo "</span></dt>
\t\t<dd><textarea id=\"answers\" style=\"word-wrap: normal; overflow-x: scroll;\" name=\"answers\" rows=\"15\" cols=\"800\" >";
            // line 77
            echo ($context["ANSWERS"] ?? null);
            echo "</textarea></dd>
\t</dl>
\t</fieldset>
\t<fieldset class=\"quick\">
\t\t<input class=\"button1\" type=\"submit\" name=\"submit\" value=\"";
            // line 81
            echo $this->extensions['phpbb\template\twig\extension']->lang("SUBMIT");
            echo "\" />
\t\t<input type=\"hidden\" name=\"question_id\" value=\"";
            // line 82
            echo ($context["QUESTION_ID"] ?? null);
            echo "\" />
\t\t<input type=\"hidden\" name=\"action\" value=\"add\" />
\t\t<input  type=\"hidden\" name=\"configure\" value=\"1\" />
\t\t<input  type=\"hidden\" name=\"select_captcha\" value=\"";
            // line 85
            echo ($context["CLASS"] ?? null);
            echo "\" />

\t\t";
            // line 87
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>
";
        }
        // line 91
        echo "
";
        // line 92
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "captcha_qa_acp.html", 92)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "captcha_qa_acp.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  305 => 92,  302 => 91,  295 => 87,  290 => 85,  284 => 82,  280 => 81,  273 => 77,  267 => 76,  261 => 73,  255 => 72,  234 => 69,  228 => 68,  217 => 64,  209 => 63,  202 => 62,  197 => 60,  191 => 58,  185 => 55,  181 => 54,  178 => 53,  175 => 52,  168 => 48,  163 => 46,  158 => 44,  152 => 41,  146 => 37,  131 => 34,  127 => 33,  122 => 32,  119 => 30,  115 => 29,  107 => 24,  103 => 23,  99 => 22,  93 => 19,  85 => 14,  78 => 11,  76 => 10,  72 => 9,  67 => 7,  54 => 5,  49 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "captcha_qa_acp.html", "");
    }
}
