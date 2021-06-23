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

/* @PrestaShop/Admin/Configure/AdvancedParameters/system_information.html.twig */
class __TwigTemplate_e975699f7c0f8a575258666802ff30be2aebe0767471a6720b8cf860846b9509 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 25
        return "@PrestaShop/Admin/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Configure/AdvancedParameters/system_information.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@PrestaShop/Admin/Configure/AdvancedParameters/system_information.html.twig"));

        $this->parent = $this->loadTemplate("@PrestaShop/Admin/layout.html.twig", "@PrestaShop/Admin/Configure/AdvancedParameters/system_information.html.twig", 25);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 28
    public function block_content($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 29
        echo "<div class=\"row\">
    <div class=\"col-lg-6\">
        <div class=\"card\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> ";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Configuration information", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    <p>";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("This information must be provided when you report an issue on our bug tracker or forum.", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</p>
                </div>
            </div>
        </div>
        ";
        // line 41
        if ($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "notHostMode", [])) {
            // line 42
            echo "        <div class=\"card\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> ";
            // line 44
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Server information", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    ";
            // line 48
            if ( !twig_test_empty($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "uname", []))) {
                // line 49
                echo "                        <p>
                            <strong>";
                // line 50
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Server information", [], "Admin.Advparameters.Feature"), "html", null, true);
                echo "</strong> ";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "uname", []), "html", null, true);
                echo "
                        </p>
                    ";
            }
            // line 53
            echo "                    <p>
                        <strong>";
            // line 54
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Server software version:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "server", []), "version", []), "html", null, true);
            echo "
                    </p>
                    <p>
                        <strong>";
            // line 57
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("PHP version:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "server", []), "php", []), "version", []), "html", null, true);
            echo "
                    </p>
                    <p>
                        <strong>";
            // line 60
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Memory limit:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "server", []), "php", []), "memoryLimit", []), "html", null, true);
            echo "
                    </p>
                    <p>
                        <strong>";
            // line 63
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Max execution time:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "server", []), "php", []), "maxExecutionTime", []), "html", null, true);
            echo "
                    </p>
                    <p>
                        <strong>";
            // line 66
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Upload Max File size:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "server", []), "php", []), "maxFileSizeUpload", []), "html", null, true);
            echo "
                    </p>
                    ";
            // line 68
            if ($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "instaWebInstalled", [])) {
                // line 69
                echo "                        <p>";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("PageSpeed module for Apache installed (mod_instaweb)", [], "Admin.Advparameters.Feature"), "html", null, true);
                echo "</p>
                    ";
            }
            // line 71
            echo "                </div>
            </div>
        </div>

        <div class=\"card\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> ";
            // line 77
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Database information", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    <p>
                        <strong>";
            // line 82
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("MySQL version:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "database", []), "version", []), "html", null, true);
            echo "
                    </p>
                    <p>
                        <strong>";
            // line 85
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("MySQL server:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "database", []), "server", []), "html", null, true);
            echo "
                    </p>
                    <p>
                        <strong>";
            // line 88
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("MySQL name:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "database", []), "name", []), "html", null, true);
            echo "
                    </p>
                    <p>
                        <strong>";
            // line 91
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("MySQL user:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "database", []), "user", []), "html", null, true);
            echo "
                    </p>
                    <p>
                        <strong>";
            // line 94
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Tables prefix:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "database", []), "prefix", []), "html", null, true);
            echo "
                    </p>
                    <p>
                        <strong>";
            // line 97
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("MySQL engine:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "database", []), "engine", []), "html", null, true);
            echo "
                    </p>
                    <p>
                        <strong>";
            // line 100
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("MySQL driver:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "database", []), "driver", []), "html", null, true);
            echo "
                    </p>
                </div>
            </div>
        </div>
    </div>
    ";
        }
        // line 107
        echo "    <div class=\"col-lg-6\">
        <div class=\"card\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> ";
        // line 110
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Store information", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    <p>
                        <strong>";
        // line 115
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("PrestaShop version:", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</strong> ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "shop", []), "version", []), "html", null, true);
        echo "
                    </p>
                    <p>
                        <strong>";
        // line 118
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Shop URL:", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</strong> ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "shop", []), "url", []), "html", null, true);
        echo "
                    </p>
                    <p>
                        <strong>";
        // line 121
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Shop path:", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</strong> ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "shop", []), "path", []), "html", null, true);
        echo "
                    </p>
                    <p>
                        <strong>";
        // line 124
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Current theme in use:", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</strong> ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "shop", []), "theme", []), "html", null, true);
        echo "
                    </p>
                </div>
            </div>
        </div>

        <div class=\"card\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> ";
        // line 132
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Mail configuration", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    <p>
                        <strong>";
        // line 137
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Mail method:", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</strong>

                        ";
        // line 139
        if ($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "isNativePHPmail", [])) {
            // line 140
            echo "                        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("You are using /usr/sbin/sendmail", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "
                        ";
        } else {
            // line 142
            echo "                        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("You are using your own SMTP parameters.", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</p>
                    <p>
                        <strong>";
            // line 144
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("SMTP server:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "smtp", []), "server", []), "html", null, true);
            echo "
                    </p>
                    <p>
                        <strong>";
            // line 147
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("SMTP username:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong>
                        ";
            // line 148
            if ( !twig_test_empty($this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "smtp", []), "user", []))) {
                // line 149
                echo "                            ";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Defined", [], "Admin.Advparameters.Feature"), "html", null, true);
                echo "
                        ";
            } else {
                // line 151
                echo "                            <span style=\"color:red;\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Not defined", [], "Admin.Advparameters.Feature"), "html", null, true);
                echo "</span>
                        ";
            }
            // line 153
            echo "                    </p>
                    <p>
                        <strong>";
            // line 155
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("SMTP password:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong>
                        ";
            // line 156
            if ( !twig_test_empty($this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "smtp", []), "password", []))) {
                // line 157
                echo "                            ";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Defined", [], "Admin.Advparameters.Feature"), "html", null, true);
                echo "
                        ";
            } else {
                // line 159
                echo "                            <span style=\"color:red;\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Not defined", [], "Admin.Advparameters.Feature"), "html", null, true);
                echo "</span>
                        ";
            }
            // line 161
            echo "                    </p>
                    <p>
                        <strong>";
            // line 163
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Encryption:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "smtp", []), "encryption", []), "html", null, true);
            echo "
                    </p>
                    <p>
                        <strong>";
            // line 166
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("SMTP port:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "smtp", []), "port", []), "html", null, true);
            echo "
                    </p>
                    ";
        }
        // line 169
        echo "                </div>
            </div>
        </div>

        <div class=\"card\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> ";
        // line 175
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Your information", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    <p>
                        <strong>";
        // line 180
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Your web browser:", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</strong> ";
        echo twig_escape_filter($this->env, ($context["userAgent"] ?? $this->getContext($context, "userAgent")), "html", null, true);
        echo "
                    </p>
                </div>
            </div>
        </div>

        <div class=\"card\" id=\"checkConfiguration\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> ";
        // line 188
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Check your configuration", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    <p>
                        <strong>";
        // line 193
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Required parameters:", [], "Admin.Advparameters.Feature"), "html", null, true);
        echo "</strong>
                    ";
        // line 194
        if (($this->getAttribute(($context["requirements"] ?? $this->getContext($context, "requirements")), "failRequired", []) == false)) {
            // line 195
            echo "                        <span class=\"text-success\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("OK", [], "Admin.Advparameters.Notification"), "html", null, true);
            echo "</span>
                    </p>
                    ";
        } else {
            // line 198
            echo "                        <span class=\"text-danger\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Please fix the following error(s)", [], "Admin.Advparameters.Notification"), "html", null, true);
            echo "</span>
                        </p>
                        <ul>
                            ";
            // line 201
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["requirements"] ?? $this->getContext($context, "requirements")), "testsRequired", []));
            foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                // line 202
                echo "                                ";
                if (("fail" == $context["value"])) {
                    // line 203
                    echo "                                    <li>";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["requirements"] ?? $this->getContext($context, "requirements")), "testsErrors", []), $context["key"], [], "array"), "html", null, true);
                    echo "</li>
                                ";
                }
                // line 205
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 206
            echo "                        </ul>
                    ";
        }
        // line 208
        echo "                    ";
        if ($this->getAttribute(($context["requirements"] ?? null), "failOptional", [], "any", true, true)) {
            // line 209
            echo "                        <p>
                        <strong>";
            // line 210
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Optional parameters:", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "</strong>
                        ";
            // line 211
            if (($this->getAttribute(($context["requirements"] ?? $this->getContext($context, "requirements")), "failOptional", []) == false)) {
                // line 212
                echo "                            <span class=\"text-success\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("OK", [], "Admin.Advparameters.Notification"), "html", null, true);
                echo "</span>
                            </p>
                        ";
            } else {
                // line 215
                echo "                            <span class=\"text-danger\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Please fix the following error(s)", [], "Admin.Advparameters.Notification"), "html", null, true);
                echo "</span>
                            </p>
                            <ul>
                                ";
                // line 218
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["requirements"] ?? $this->getContext($context, "requirements")), "testsOptional", []));
                foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                    // line 219
                    echo "                                    ";
                    if (("fail" == $context["value"])) {
                        // line 220
                        echo "                                        <li>";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["requirements"] ?? $this->getContext($context, "requirements")), "testsErrors", []), $context["key"], [], "array"), "html", null, true);
                        echo "</li>
                                    ";
                    }
                    // line 222
                    echo "                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 223
                echo "                            </ul>
                        ";
            }
            // line 225
            echo "                    ";
        }
        // line 226
        echo "                </div>
            </div>
        </div>
    </div>
</div>
";
        // line 231
        if ($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "notHostMode", [])) {
            // line 232
            echo "    <div class=\"card\">
        <h3 class=\"card-header\">
            <i class=\"material-icons\">info_outline</i> ";
            // line 234
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("List of changed files", [], "Admin.Advparameters.Feature"), "html", null, true);
            echo "
        </h3>
        <div class=\"card-block\">
            <div class=\"card-text\" id=\"changedFiles\">
                <i class=\"material-icons\">loop</i> ";
            // line 238
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Checking files...", [], "Admin.Advparameters.Notification"), "html", null, true);
            echo "
            </div>
        </div>
    </div>
";
        }
        // line 243
        if ($this->getAttribute(($context["system"] ?? $this->getContext($context, "system")), "notHostMode", [])) {
            // line 244
            echo "    <script>
        \$(document).ready(function()
        {
            var translations = {
                missing: '";
            // line 248
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Missing files", [], "Admin.Advparameters.Notification"), "js"), "html", null, true);
            echo "',
                updated: '";
            // line 249
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Updated files", [], "Admin.Advparameters.Notification"), "js"), "html", null, true);
            echo "',
                changesDetected: '";
            // line 250
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Changed/missing files have been detected.", [], "Admin.Advparameters.Notification"), "js"), "html", null, true);
            echo "',
                noChangeDetected: '";
            // line 251
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("No change has been detected in your files.", [], "Admin.Advparameters.Notification"), "js"), "html", null, true);
            echo "'
            };

            \$.ajax({
                type: 'POST',
                url: '";
            // line 256
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("admin_system_information_check_files");
            echo "',
                data: {},
                dataType: 'json',
                success: function(json)
                {
                    var tab = {
                        'missing': translations.missing,
                        'updated': translations.updated,
                    };

                    if (json.missing.length || json.updated.length)
                        \$('#changedFiles').html('<div class=\"alert alert-warning\" role=\"alert\"><p class=\"alert-text\">'+ translations.changesDetected +'</p></div>');
                    else
                        \$('#changedFiles').html('<div class=\"alert alert-success\" role=\"alert\"><p class=\"alert-text\">'+ translations.noChangeDetected +'</p></div>');

                    \$.each(tab, function(key, lang) {
                        if (json[key].length) {
                            var html = \$('<ul>').attr('id', key+'_files');
                            \$(json[key]).each(function(key, file) {
                                html.append(\$('<li>').html(file))
                            });
                            \$('#changedFiles')
                                .append(\$('<h4>').html(lang+' ('+json[key].length+')'))
                                .append(html);
                        }
                    });
                }
            });
        });
    </script>
";
        }
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Configure/AdvancedParameters/system_information.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  565 => 256,  557 => 251,  553 => 250,  549 => 249,  545 => 248,  539 => 244,  537 => 243,  529 => 238,  522 => 234,  518 => 232,  516 => 231,  509 => 226,  506 => 225,  502 => 223,  496 => 222,  490 => 220,  487 => 219,  483 => 218,  476 => 215,  469 => 212,  467 => 211,  463 => 210,  460 => 209,  457 => 208,  453 => 206,  447 => 205,  441 => 203,  438 => 202,  434 => 201,  427 => 198,  420 => 195,  418 => 194,  414 => 193,  406 => 188,  393 => 180,  385 => 175,  377 => 169,  369 => 166,  361 => 163,  357 => 161,  351 => 159,  345 => 157,  343 => 156,  339 => 155,  335 => 153,  329 => 151,  323 => 149,  321 => 148,  317 => 147,  309 => 144,  303 => 142,  297 => 140,  295 => 139,  290 => 137,  282 => 132,  269 => 124,  261 => 121,  253 => 118,  245 => 115,  237 => 110,  232 => 107,  220 => 100,  212 => 97,  204 => 94,  196 => 91,  188 => 88,  180 => 85,  172 => 82,  164 => 77,  156 => 71,  150 => 69,  148 => 68,  141 => 66,  133 => 63,  125 => 60,  117 => 57,  109 => 54,  106 => 53,  98 => 50,  95 => 49,  93 => 48,  86 => 44,  82 => 42,  80 => 41,  73 => 37,  66 => 33,  60 => 29,  51 => 28,  29 => 25,);
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
{% extends '@PrestaShop/Admin/layout.html.twig' %}
{% trans_default_domain \"Admin.Advparameters.Feature\" %}

{% block content %}
<div class=\"row\">
    <div class=\"col-lg-6\">
        <div class=\"card\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> {{ 'Configuration information'|trans }}
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    <p>{{ 'This information must be provided when you report an issue on our bug tracker or forum.'|trans }}</p>
                </div>
            </div>
        </div>
        {% if system.notHostMode %}
        <div class=\"card\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> {{ 'Server information'|trans }}
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    {% if system.uname is not empty %}
                        <p>
                            <strong>{{ 'Server information'|trans }}</strong> {{ system.uname }}
                        </p>
                    {% endif %}
                    <p>
                        <strong>{{ 'Server software version:'|trans }}</strong> {{ system.server.version }}
                    </p>
                    <p>
                        <strong>{{ 'PHP version:'|trans }}</strong> {{ system.server.php.version }}
                    </p>
                    <p>
                        <strong>{{ 'Memory limit:'|trans }}</strong> {{ system.server.php.memoryLimit }}
                    </p>
                    <p>
                        <strong>{{ 'Max execution time:'|trans }}</strong> {{ system.server.php.maxExecutionTime }}
                    </p>
                    <p>
                        <strong>{{ 'Upload Max File size:'|trans }}</strong> {{ system.server.php.maxFileSizeUpload }}
                    </p>
                    {% if system.instaWebInstalled %}
                        <p>{{ 'PageSpeed module for Apache installed (mod_instaweb)'|trans }}</p>
                    {% endif %}
                </div>
            </div>
        </div>

        <div class=\"card\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> {{ 'Database information'|trans({}, 'Admin.Advparameters.Feature') }}
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    <p>
                        <strong>{{ 'MySQL version:'|trans }}</strong> {{ system.database.version }}
                    </p>
                    <p>
                        <strong>{{ 'MySQL server:'|trans }}</strong> {{ system.database.server }}
                    </p>
                    <p>
                        <strong>{{ 'MySQL name:'|trans }}</strong> {{ system.database.name }}
                    </p>
                    <p>
                        <strong>{{ 'MySQL user:'|trans }}</strong> {{ system.database.user }}
                    </p>
                    <p>
                        <strong>{{ 'Tables prefix:'|trans }}</strong> {{ system.database.prefix }}
                    </p>
                    <p>
                        <strong>{{ 'MySQL engine:'|trans }}</strong> {{ system.database.engine }}
                    </p>
                    <p>
                        <strong>{{ 'MySQL driver:'|trans }}</strong> {{ system.database.driver }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    {% endif %}
    <div class=\"col-lg-6\">
        <div class=\"card\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> {{ 'Store information'|trans }}
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    <p>
                        <strong>{{ 'PrestaShop version:'|trans }}</strong> {{ system.shop.version }}
                    </p>
                    <p>
                        <strong>{{ 'Shop URL:'|trans }}</strong> {{ system.shop.url }}
                    </p>
                    <p>
                        <strong>{{ 'Shop path:'|trans }}</strong> {{ system.shop.path }}
                    </p>
                    <p>
                        <strong>{{ 'Current theme in use:'|trans }}</strong> {{ system.shop.theme }}
                    </p>
                </div>
            </div>
        </div>

        <div class=\"card\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> {{ 'Mail configuration'|trans }}
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    <p>
                        <strong>{{ 'Mail method:'|trans }}</strong>

                        {% if system.isNativePHPmail %}
                        {{ 'You are using /usr/sbin/sendmail'|trans }}
                        {% else %}
                        {{ 'You are using your own SMTP parameters.'|trans }}</p>
                    <p>
                        <strong>{{ 'SMTP server:'|trans }}</strong> {{ system.smtp.server }}
                    </p>
                    <p>
                        <strong>{{ 'SMTP username:'|trans }}</strong>
                        {% if system.smtp.user is not empty %}
                            {{ 'Defined'|trans }}
                        {% else %}
                            <span style=\"color:red;\">{{ 'Not defined'|trans }}</span>
                        {% endif %}
                    </p>
                    <p>
                        <strong>{{ 'SMTP password:'|trans }}</strong>
                        {% if system.smtp.password is not empty %}
                            {{ 'Defined'|trans }}
                        {% else %}
                            <span style=\"color:red;\">{{ 'Not defined'|trans }}</span>
                        {% endif %}
                    </p>
                    <p>
                        <strong>{{ 'Encryption:'|trans }}</strong> {{ system.smtp.encryption }}
                    </p>
                    <p>
                        <strong>{{ 'SMTP port:'|trans }}</strong> {{ system.smtp.port }}
                    </p>
                    {% endif %}
                </div>
            </div>
        </div>

        <div class=\"card\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> {{ 'Your information'|trans }}
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    <p>
                        <strong>{{ 'Your web browser:'|trans }}</strong> {{ userAgent }}
                    </p>
                </div>
            </div>
        </div>

        <div class=\"card\" id=\"checkConfiguration\">
            <h3 class=\"card-header\">
                <i class=\"material-icons\">info_outline</i> {{ 'Check your configuration'|trans }}
            </h3>
            <div class=\"card-block\">
                <div class=\"card-text\">
                    <p>
                        <strong>{{ 'Required parameters:'|trans }}</strong>
                    {% if requirements.failRequired == false %}
                        <span class=\"text-success\">{{ 'OK'|trans({}, 'Admin.Advparameters.Notification') }}</span>
                    </p>
                    {% else %}
                        <span class=\"text-danger\">{{ 'Please fix the following error(s)'|trans({}, 'Admin.Advparameters.Notification') }}</span>
                        </p>
                        <ul>
                            {% for key, value in requirements.testsRequired %}
                                {% if 'fail' == value %}
                                    <li>{{ requirements.testsErrors[key] }}</li>
                                {% endif %}
                            {% endfor %}
                        </ul>
                    {% endif %}
                    {% if requirements.failOptional is defined %}
                        <p>
                        <strong>{{ 'Optional parameters:'|trans }}</strong>
                        {% if requirements.failOptional == false %}
                            <span class=\"text-success\">{{ 'OK'|trans({}, 'Admin.Advparameters.Notification') }}</span>
                            </p>
                        {% else %}
                            <span class=\"text-danger\">{{ 'Please fix the following error(s)'|trans({}, 'Admin.Advparameters.Notification') }}</span>
                            </p>
                            <ul>
                                {% for key, value in requirements.testsOptional %}
                                    {% if 'fail' == value %}
                                        <li>{{ requirements.testsErrors[key] }}</li>
                                    {% endif %}
                                {% endfor %}
                            </ul>
                        {% endif %}
                    {% endif %}
                </div>
            </div>
        </div>
    </div>
</div>
{% if system.notHostMode %}
    <div class=\"card\">
        <h3 class=\"card-header\">
            <i class=\"material-icons\">info_outline</i> {{ 'List of changed files'|trans }}
        </h3>
        <div class=\"card-block\">
            <div class=\"card-text\" id=\"changedFiles\">
                <i class=\"material-icons\">loop</i> {{ 'Checking files...'|trans({}, 'Admin.Advparameters.Notification') }}
            </div>
        </div>
    </div>
{% endif %}
{% if system.notHostMode %}
    <script>
        \$(document).ready(function()
        {
            var translations = {
                missing: '{{ \"Missing files\"|trans({}, \"Admin.Advparameters.Notification\")|e('js') }}',
                updated: '{{ \"Updated files\"|trans({}, \"Admin.Advparameters.Notification\")|e('js') }}',
                changesDetected: '{{ \"Changed/missing files have been detected.\"|trans({}, \"Admin.Advparameters.Notification\")|e('js') }}',
                noChangeDetected: '{{ \"No change has been detected in your files.\"|trans({}, \"Admin.Advparameters.Notification\")|e('js') }}'
            };

            \$.ajax({
                type: 'POST',
                url: '{{ path(\"admin_system_information_check_files\") }}',
                data: {},
                dataType: 'json',
                success: function(json)
                {
                    var tab = {
                        'missing': translations.missing,
                        'updated': translations.updated,
                    };

                    if (json.missing.length || json.updated.length)
                        \$('#changedFiles').html('<div class=\"alert alert-warning\" role=\"alert\"><p class=\"alert-text\">'+ translations.changesDetected +'</p></div>');
                    else
                        \$('#changedFiles').html('<div class=\"alert alert-success\" role=\"alert\"><p class=\"alert-text\">'+ translations.noChangeDetected +'</p></div>');

                    \$.each(tab, function(key, lang) {
                        if (json[key].length) {
                            var html = \$('<ul>').attr('id', key+'_files');
                            \$(json[key]).each(function(key, file) {
                                html.append(\$('<li>').html(file))
                            });
                            \$('#changedFiles')
                                .append(\$('<h4>').html(lang+' ('+json[key].length+')'))
                                .append(html);
                        }
                    });
                }
            });
        });
    </script>
{% endif %}
{% endblock %}
", "@PrestaShop/Admin/Configure/AdvancedParameters/system_information.html.twig", "/home/codeoperativeco/public_html/src/PrestaShopBundle/Resources/views/Admin/Configure/AdvancedParameters/system_information.html.twig");
    }
}
