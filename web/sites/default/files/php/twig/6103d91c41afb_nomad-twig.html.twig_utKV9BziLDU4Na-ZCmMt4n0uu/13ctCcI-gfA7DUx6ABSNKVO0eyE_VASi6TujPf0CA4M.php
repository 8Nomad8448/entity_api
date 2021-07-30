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

/* modules/custom/nomad/templates/nomad-twig.html.twig */
class __TwigTemplate_1b898837c4fcfc987fbf5a439890d77e2aaadb5e9153a04760be6c03b2fa9e05 extends \Twig\Template
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
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("nomad/gests-style"), "html", null, true);
        echo "
";
        // line 2
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("core/drupal.dialog.ajax"), "html", null, true);
        echo "

<div class=\"row\">
  <h5>";
        // line 5
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["markup"] ?? null), 5, $this->source), "html", null, true);
        echo "</h5>
  <div class=\"col-12\">
    ";
        // line 7
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["form"] ?? null), 7, $this->source), "html", null, true);
        echo "
  </div>
</div>
  ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 11
            echo "  <div class=\"dboutput_wrapper row\">
    <div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 gests\">
      <span class=\"gests_avatar\"><a href=\"";
            // line 13
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "Avatar__target_id", [], "any", false, false, true, 13), 13, $this->source), "html", null, true);
            echo "\" target=\"_blank\"><img src=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "Avatar__target_id", [], "any", false, false, true, 13), 13, $this->source), "html", null, true);
            echo "\" title=\"User chosen avatar\" alt=\"user avatar\"></a></span>
      <div>
        <span class=\"titles\">";
            // line 15
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Name:"));
            echo "</span>
        <p class=\"gests_name\">";
            // line 16
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "Name", [], "any", false, false, true, 16), 16, $this->source), "html", null, true);
            echo "</p>
        <span class=\"titles\">";
            // line 17
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Created:"));
            echo "</span>
        <p class=\"gests_created\"> ";
            // line 18
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "Date", [], "any", false, false, true, 18), 18, $this->source), "html", null, true);
            echo "</p>
      </div>
    </div>
    <div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 gests_image\">
      <p class=\"titles\">";
            // line 22
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Message:"));
            echo "</p>
      <p class=\"gests_comment\"> ";
            // line 23
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "Feedback__value", [], "any", false, false, true, 23), 23, $this->source), "html", null, true);
            echo "</p>
      <div>
        ";
            // line 25
            if (twig_get_attribute($this->env, $this->source, $context["item"], "Image__target_id", [], "any", false, false, true, 25)) {
                // line 26
                echo "          <a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "Image__target_id", [], "any", false, false, true, 26), 26, $this->source), "html", null, true);
                echo "\" target=\"_blank\">
            <img src='";
                // line 27
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "Image__target_id", [], "any", false, false, true, 27), 27, $this->source), "html", null, true);
                echo "' alt=\"Photo that user decided to add\">
          </a>
        ";
            }
            // line 30
            echo "      </div>
    </div>
    <div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 gests_contacts\">
      <div>
        <p class=\"titles\">";
            // line 34
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Gest email:"));
            echo "</p>
        <p class=\"gests_email\"> ";
            // line 35
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "Email", [], "any", false, false, true, 35), 35, $this->source), "html", null, true);
            echo "</p>
        <br>
        <p class=\"titles\">";
            // line 37
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Contact phone:"));
            echo "</p>
        <p class=\"gests_phone\"> ";
            // line 38
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "Phone", [], "any", false, false, true, 38), 38, $this->source), "html", null, true);
            echo "</p>
        <br>
        ";
            // line 40
            if (twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "hasPermission", [0 => "administer nodes"], "method", false, false, true, 40)) {
                // line 41
                echo "          <br>
          <span class=\"rm_btn\">
            <a href=\"/admin/content/nomad/manage/delete/";
                // line 43
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, true, 43), 43, $this->source), "html", null, true);
                echo "?destination=";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["root"] ?? null), 43, $this->source), "html", null, true);
                echo "\" class=\"rm_button use-ajax\" data-dialog-type=\"modal\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("remove"));
                echo "</a>
            <a href=\"/admin/content/nomad/manage/";
                // line 44
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, true, 44), 44, $this->source), "html", null, true);
                echo "?destination=";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["root"] ?? null), 44, $this->source), "html", null, true);
                echo "\" class=\"edit_button\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("edit"));
                echo "</a>
          </span>
        ";
            }
            // line 47
            echo "      </div>
    </div>

  </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "

";
    }

    public function getTemplateName()
    {
        return "modules/custom/nomad/templates/nomad-twig.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 52,  164 => 47,  154 => 44,  146 => 43,  142 => 41,  140 => 40,  135 => 38,  131 => 37,  126 => 35,  122 => 34,  116 => 30,  110 => 27,  105 => 26,  103 => 25,  98 => 23,  94 => 22,  87 => 18,  83 => 17,  79 => 16,  75 => 15,  68 => 13,  64 => 11,  60 => 10,  54 => 7,  49 => 5,  43 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/nomad/templates/nomad-twig.html.twig", "/var/www/web/modules/custom/nomad/templates/nomad-twig.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 10, "if" => 25);
        static $filters = array("escape" => 1, "trans" => 15);
        static $functions = array("attach_library" => 1);

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if'],
                ['escape', 'trans'],
                ['attach_library']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
