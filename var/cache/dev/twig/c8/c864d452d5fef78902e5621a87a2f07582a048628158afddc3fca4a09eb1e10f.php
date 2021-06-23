<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @PrestaShop/Admin/Configure/AdvancedParameters/Webservice/Blocks/form.html.twig */
class __TwigTemplate_acedf7f75f9b9b3b1b696e5ac883b4d62860e0ad079ceafc7bd8904d983dbc9e extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'webservice_key_form' => [$this, 'block_webservice_key_form'],
            'webservice_key_form_rest' => [$this, 'block_webservice_key_form_rest'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Configure/AdvancedParameters/Webservice/Blocks/form.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Configure/AdvancedParameters/Webservice/Blocks/form.html.twig"));

        // line 25
        echo "
";
        // line 26
        $context["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Configure/AdvancedParameters/Webservice/Blocks/form.html.twig", 26)->unwrap();
        // line 27
        echo "
";
        // line 28
        $this->displayBlock('webservice_key_form', $context, $blocks);
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function block_webservice_key_form($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "webservice_key_form"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "webservice_key_form"));

        // line 29
        echo "  ";
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["webserviceKeyForm"] ?? $this->getContext($context, "webserviceKeyForm")), 'form_start');
        echo "
  <div class=\"card\">
    <h3 class=\"card-header\">
      ";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Webservice Accounts", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "
    </h3>
    <div class=\"card-block row\">
      <div class=\"card-text\">
        ";
        // line 36
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["webserviceKeyForm"] ?? $this->getContext($context, "webserviceKeyForm")), 'errors');
        echo "

        ";
        // line 38
        echo $context["ps"]->getform_group_row($this->getAttribute(($context["webserviceKeyForm"] ?? $this->getContext($context, "webserviceKeyForm")), "key", []), [], ["label" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Key", [], "Admin.Advparameters.Feature"), "help" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Webservice account key.", [], "Admin.Advparameters.Feature")]);
        // line 41
        echo "

        ";
        // line 43
        echo $context["ps"]->getform_group_row($this->getAttribute(($context["webserviceKeyForm"] ?? $this->getContext($context, "webserviceKeyForm")), "description", []), [], ["label" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Key description", [], "Admin.Advparameters.Feature"), "help" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Quick description of the key: who it is for, what permissions it has, etc.", [], "Admin.Advparameters.Help")]);
        // line 46
        echo "

        ";
        // line 48
        echo $context["ps"]->getform_group_row($this->getAttribute(($context["webserviceKeyForm"] ?? $this->getContext($context, "webserviceKeyForm")), "status", []), [], ["label" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Status", [], "Admin.Global")]);
        // line 50
        echo "

        <div class=\"form-group row mb-0\">
          <label class=\"form-control-label\"></label>
          <div class=\"col-sm mb-0\">
            <div class=\"alert alert-info\" role=\"alert\">
              <p class=\"alert-text\">";
        // line 56
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Set the resource permissions for this key:", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</p>
            </div>
          </div>
        </div>

        ";
        // line 61
        echo $context["ps"]->getform_group_row($this->getAttribute(($context["webserviceKeyForm"] ?? $this->getContext($context, "webserviceKeyForm")), "permissions", []), ["label" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Resource", [], "Admin.Global")], ["label" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Permissions", [], "Admin.Advparameters.Feature")]);
        // line 65
        echo "

        ";
        // line 67
        if ($this->getAttribute(($context["webserviceKeyForm"] ?? null), "shop_association", [], "any", true, true)) {
            // line 68
            echo "          ";
            echo $context["ps"]->getform_group_row($this->getAttribute(($context["webserviceKeyForm"] ?? $this->getContext($context, "webserviceKeyForm")), "shop_association", []), [], ["label" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Shop association", [], "Admin.Global")]);
            // line 70
            echo "
        ";
        }
        // line 72
        echo "
        ";
        // line 73
        $this->displayBlock('webservice_key_form_rest', $context, $blocks);
        // line 76
        echo "      </div>
    </div>
    <div class=\"card-footer\">
      <a href=\"";
        // line 79
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("admin_webservice_keys_index");
        echo "\" class=\"btn btn-outline-secondary\">
        ";
        // line 80
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Cancel", [], "Admin.Actions"), "html", null, true);
        echo "
      </a>
      <button class=\"btn btn-primary float-right\">
        ";
        // line 83
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "
      </button>
    </div>
  </div>
  ";
        // line 87
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["webserviceKeyForm"] ?? $this->getContext($context, "webserviceKeyForm")), 'form_end');
        echo "
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 73
    public function block_webservice_key_form_rest($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "webservice_key_form_rest"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "webservice_key_form_rest"));

        // line 74
        echo "          ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["webserviceKeyForm"] ?? $this->getContext($context, "webserviceKeyForm")), 'rest');
        echo "
        ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Configure/AdvancedParameters/Webservice/Blocks/form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 74,  167 => 73,  155 => 87,  148 => 83,  142 => 80,  138 => 79,  133 => 76,  131 => 73,  128 => 72,  124 => 70,  121 => 68,  119 => 67,  115 => 65,  113 => 61,  105 => 56,  97 => 50,  95 => 48,  91 => 46,  89 => 43,  85 => 41,  83 => 38,  78 => 36,  71 => 32,  64 => 29,  46 => 28,  43 => 27,  41 => 26,  38 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 *#}

{% import '@PrestaShop/Admin/macros.html.twig' as ps %}

{% block webservice_key_form %}
  {{ form_start(webserviceKeyForm) }}
  <div class=\"card\">
    <h3 class=\"card-header\">
      {{ 'Webservice Accounts'|trans({}, 'Admin.Advparameters.Feature') }}
    </h3>
    <div class=\"card-block row\">
      <div class=\"card-text\">
        {{ form_errors(webserviceKeyForm) }}

        {{ ps.form_group_row(webserviceKeyForm.key, {}, {
          'label': 'Key'|trans({}, 'Admin.Advparameters.Feature'),
          'help': 'Webservice account key.'|trans({}, 'Admin.Advparameters.Feature')
        }) }}

        {{ ps.form_group_row(webserviceKeyForm.description, {}, {
          'label': 'Key description'|trans({}, 'Admin.Advparameters.Feature'),
          'help': 'Quick description of the key: who it is for, what permissions it has, etc.'|trans({}, 'Admin.Advparameters.Help')
        }) }}

        {{ ps.form_group_row(webserviceKeyForm.status, {}, {
          'label': 'Status'|trans({}, 'Admin.Global')
        }) }}

        <div class=\"form-group row mb-0\">
          <label class=\"form-control-label\"></label>
          <div class=\"col-sm mb-0\">
            <div class=\"alert alert-info\" role=\"alert\">
              <p class=\"alert-text\">{{ 'Set the resource permissions for this key:'|trans({}, 'Admin.Advparameters.Feature') }}</p>
            </div>
          </div>
        </div>

        {{ ps.form_group_row(webserviceKeyForm.permissions, {
          'label': 'Resource'|trans({}, 'Admin.Global')
        }, {
          'label': 'Permissions'|trans({}, 'Admin.Advparameters.Feature')
        }) }}

        {% if webserviceKeyForm.shop_association is defined %}
          {{ ps.form_group_row(webserviceKeyForm.shop_association, {}, {
            'label': 'Shop association'|trans({}, 'Admin.Global')
          }) }}
        {% endif %}

        {% block webservice_key_form_rest %}
          {{ form_rest(webserviceKeyForm) }}
        {% endblock %}
      </div>
    </div>
    <div class=\"card-footer\">
      <a href=\"{{ path('admin_webservice_keys_index') }}\" class=\"btn btn-outline-secondary\">
        {{ 'Cancel'|trans({}, 'Admin.Actions') }}
      </a>
      <button class=\"btn btn-primary float-right\">
        {{ 'Save'|trans({}, 'Admin.Actions') }}
      </button>
    </div>
  </div>
  {{ form_end(webserviceKeyForm) }}
{% endblock %}
", "@PrestaShop/Admin/Configure/AdvancedParameters/Webservice/Blocks/form.html.twig", "/home/codeoperativeco/public_html/src/PrestaShopBundle/Resources/views/Admin/Configure/AdvancedParameters/Webservice/Blocks/form.html.twig");
    }
}
