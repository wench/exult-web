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

/* captcha_qa_acp_demo.html */
class __TwigTemplate_e8de00308c624a7a2c84a5b99f82a175cd78606d58f445b224c3c58f3cfe3247 extends \Twig\Template
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
        echo "<dl>
\t<dt><label for=\"answer\">";
        // line 2
        if (($context["QA_CONFIRM_QUESTION"] ?? null)) {
            echo " ";
            echo ($context["QA_CONFIRM_QUESTION"] ?? null);
            echo " ";
        } else {
            echo " ";
            echo $this->extensions['phpbb\template\twig\extension']->lang("CONFIRM_QUESTION");
            echo " ";
        }
        echo $this->extensions['phpbb\template\twig\extension']->lang("COLON");
        echo "</label><br /><span>";
        echo $this->extensions['phpbb\template\twig\extension']->lang("CONFIRM_QUESTION_EXPLAIN");
        echo "</span></dt>

\t<dd>
\t\t<input type=\"text\" tabindex=\"10\" name=\"answer\" id=\"answer\" size=\"45\" class=\"inputbox autowidth\" title=\"";
        // line 5
        echo $this->extensions['phpbb\template\twig\extension']->lang("ANSWER");
        echo "\"  />
\t</dd>
</dl>
";
    }

    public function getTemplateName()
    {
        return "captcha_qa_acp_demo.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 5,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "captcha_qa_acp_demo.html", "");
    }
}
